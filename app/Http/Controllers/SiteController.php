<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use App\Models\service;
use App\Models\Category;
use App\Models\question;
use App\Models\ReviewRating;
use  App\Http\Requests\ReviewsRequest;
class SiteController extends Controller
{
    public function home(){
        $auctions = Auction::with(['car' => function ($q) {
            $q->select('brand_id', 'series_id', 'model', );
        }]);
        $last_cars = Auction::with(['car' => function ($q){
            return $q->where('category_id', 1)->get();
        }])->where('status', '2')->orderBy('id', 'desc')->get();
        $last_taxis = Auction::with(['car' => function ($q){
            return $q->where('category_id', 2)->get();
        }])->where('status', '2')->orderBy('id', 'desc')->get();
        $last_babors = Auction::with(['car' => function ($q){
            return $q->where('category_id', 3)->get();
        }])->where('status', '2')->orderBy('id', 'desc')->get();
        $last_buses = Auction::with(['car' => function ($q){
            return $q->where('category_id', 4)->get();
        }])->where('status', '2')->orderBy('id', 'desc')->get();
        return view('Front.index')->with([
            'auctions'=> $auctions,
            'last_cars' => $last_cars,
            'last_taxis' => $last_taxis,
            'last_babors' => $last_babors,
            'last_buses' => $last_buses,
        ]);
    }

    public function availableAuctions(){
        // available = not-expired + progress
        $auctions = Auction::whereDate('closeDate', '>', now())->where('status', '2')->get();
        return view('Front.auctions')->with(['auctions' => $auctions, 'title' => 'المزادات الحالية']);
    }

    // TODO: Refactor the method
    public function auctionShow($id){
        /**
         * Preparing the reviews in that auction
         */
        $total= ReviewRating::get()->count();
        $oneStar = ReviewRating::where('star_rating', 1)->get()->count();
        $towStar = ReviewRating::where('star_rating', 2)->get()->count();
        $threeStar = ReviewRating::where('star_rating', 3)->get()->count();
        $fourStar = ReviewRating::where('star_rating',4)->get()->count();
        $fiveStar = ReviewRating::where('star_rating', 5)->get()->count();

        if ($total>0){
            $onePrsent=$oneStar/$total*100;
            $towPrsent=$towStar /$total*100;
            $threePrsent=$threeStar/$total*100;
            $fourPrsent=$fourStar/$total*100;
            $fivePrsent=$fiveStar/$total*100;
            $avg=round($total/5);
            $avgBeforRound=$total/5;
        }
        else{
            $total=.001; 
            $onePrsent=$oneStar/$total*100;
            $towPrsent=$towStar /$total*100;
            $threePrsent=$threeStar/$total*100;
            $fourPrsent=$fourStar/$total*100;
            $fivePrsent=$fiveStar/$total*100;
            $avg=round($total/5);
            $avgBeforRound=$total/5;
        }        
        /**
         * Preparing the auction details
         */
        $found = Auction::find($id);
        if($found){
            $auction = Auction::whereId($id)
                                ->whereNotIn('status', ['0','1'])
                                ->with('bids', function($q){
                                    $q->orderBy('id', 'desc')->first();
                                })->first();
            if($auction){
                $similars = Auction::with(['car' => function($q) use ($auction){
                        $q->where('category_id', $auction->car->category_id)->get();
                            }])->with('bids', function($q){
                                $q->orderBy('id', 'desc')->first();
                            })->get();
                return view('Front.details')->with([
                        'auction'=>$auction,
                        'similars' => $similars,
                        'one' => $onePrsent ,
                        'oneStar'=>$oneStar,
                        'two' => $towPrsent ,
                        'twoStar'=>$towStar,
                        'three' => $threePrsent ,
                        'threeStar'=>$threeStar,
                        'four' => $fourPrsent ,
                        'fourStar'=>$fourStar,
                        'five' => $fivePrsent ,
                        'fiveStar'=>$fiveStar,
                        'total'=>$avg,
                        'totalstar'=>$avgBeforRound,     
                ] );
            }
        }
        return response()->view('Front.errors.404', []);
    }

    public function auctionByCarStatus($status){
        $status = $status == 'old'? '0': '1';
        
        $auctions = Auction::whereNotIn('status', ['0','1'])->with('bids', function($q){
            $q->orderBy('id', 'desc')->first();
        })->with('car', function ($q) use ($status){
            $q->where('status', $status)->get();
        })->get();
        if($auctions){
            $title = $status == '0' ? 'مستعملة': 'جديدة';
            return view('Front.auctions')->with(['auctions' => $auctions, 
            'title' => 'السيارات ال'.$title]);
        }
        return response()->view('Front.errors.404', []);
    }

    public function ServicesShow(){
        $services = service::where('is_active', '1')->get();
        return view('Front.services', ['services' => $services]);
    }
    public function categoriesShow(){
        $categories = Category::where('is_active', '1')->get();
        return view('Front.include.produacts', ['Categories' => $categories]);
    }
    public function questionShow(){
        $questions = question::where('is_active', '1')->get();
        return view('Front.FAQ', ['questions' => $questions]);
    }
    public function reviewstore(ReviewsRequest $request){
        $review = new ReviewRating();
        $review->user_id = $request->user_id;
        $review->name    = $request->name;
        $review->comments= $request->comment;
        $review->star_rating = $request->rating;
        $review->save();
        return redirect()->back()->  with(['successAdd'=>'تم الاحتفاظ بتقييمك شكرا لك']);
        return back()->with(['errorAdd'=>'حدث خطأ، حاول مرة أخرى']);
    } 
}
