<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Notifications\NotificationController;
use App\Models\Brand;
use App\Models\Series;
use App\Models\Auction;
use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Notification;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\String_;
use Pusher\Pusher;

class AcutionController extends Controller
{

    public function index()
    {
        $auctions = Auction::orderBy('id')->get();
        $brands = Brand::where('is_active', 1)->select('id', 'name')->get();
        $series = Series::where('is_active', 1)->select('id', 'name')->get();
        return view('Admin.auctions.auctions')->with([
            'auctions'=> $auctions,
            'brands'  => $brands,
            'series'  => $series
        ]);
    }

    public function indexWithFilter(Request $request){
        $brands = Brand::where('is_active', 1)->select('id', 'name')->get();
        $series = Series::where('is_active', 1)->select('id', 'name')->get();

        $q = DB::table('auctions');
        if($request->has('status'))
             $q->where('status', $request->status);

        if($request->has('brand'))
             $q->where('id', $request->brand);

        if($request->has('series'))
            $q->where('id', $request->series);
        $auctions = $q->get();
        return view('Admin.auctions.auctions')->with([
            'auctions'=> $auctions,
            'brands'  => $brands,
            'series'  => $series
            ]
        );
    }
    public function action(Request $request, $id)
    {
        $found = Auction::find($id);
        if(!$found)
            return abort('404');
        $auction = Auction::whereId($id);
        if($request->has('approve')){
            $auction->update(['status' => '2', 'startDate' => now()]);


            $options = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
            );
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $notification = new Notification();
//            $auction = Auction::whereId('id');
                $user=User::where('id',$found->auctioneer_id)->first();
//            $users = User::all()->except(Auth::id());
                    $notification = Notification::create([
                            'message' => "تمت إضافة مزاد جديد",
                        'user_id' => $user->id ,
                        'state' => 0,
                        'link' => $found->id,
                        'type' => 1
                    ]);
                    $brand = $found->car->brand->name;
                    $series = $found->car->series->name;
                    $model = $found->car->model;
                    $info = array('brand'=>$brand,'series'=>$series,'model'=>$model);
                    $data['message'] = implode("," , $info);
                    $data['link'] = $found->id;
                    $data['price'] = $found->openingBid;
                    $data['endDate'] = $found->closeDate;
                    $data['type'] = $notification->type;
                    $data['user_id'] = $user->id;

                    $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data);

        }

        if($request->has('disapprove')){
            Validator::validate($request->all(), [
                'reject_reason' => 'required|string',
            ], [
                'reject_reason.required' => 'حقل السبب مطلوب',
                'reject_reason.string'   => 'هذاالحقل يجب أن يكون نصا',
            ]);
            $auction->update(['status' => '1']);

            $auc = Auction::find($id);
            $auc->rejectReason = $request->reject_reason;
            $auc->save();
        }



        return redirect()->back();
    }

    public function showDetails(Request $request, $id)
    {
        $found = Auction::find($id);
        if($found){
            $auction = Auction::where('id',$id)->with('bids', function ($q){
                //get last bid of this auction
                $q -> orderBy('id', 'desc')->first();
            })->first();
            if($auction){
                return view('Admin.auctions.auctionDetails')->with('auction', $auction);
            }
        }
        return response()->view('Front.404', []);
    }
}
