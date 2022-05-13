<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\User;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Models\Notification;
class NotificationController extends Controller
{

    public function __construct()
    {

    }

    public function newAuctionNotification(Auction $auction)
    {

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
        $user=User::where('id',$auction->auctioneer_id)->first();
        $notification = Notification::create([
            'message' => "تمت إضافة مزاد جديد",
            'user_id' => $user->id ,
            'state' => 0,
            'link' => $auction->id,
            'type' => 1
        ]);
        $brand = $auction->car->brand->name;
        $series = $auction->car->series->name;
        $model = $auction->car->model;
        $info = array('brand'=>$brand,'series'=>$series,'model'=>$model);
        $data['message'] = implode("," , $info);
        $data['link'] = $auction->id;
        $data['price'] = $auction->openingBid;
        $data['endDate'] = $auction->closeDate;
        $data['type'] = $notification->type;
        $data['user_id'] = $user->id;

        $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data);
    }

    public function auctionAccepted(Auction $auction)
    {
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
        $user=User::where('id',$auction->auctioneer_id)->first();
        $notification = Notification::create([
            'message' => "تمت الموافقة على مزادك من قبل إدارة الموقع",
            'user_id' => $user->id,
            'state' => 0,
            'link' => $auction->id,
            'type' => 2
        ]);
        $data['message'] = $notification->message;
        $data['link'] = $auction->id;
        $data['price'] = $auction->openingBid;
        $data['endDate'] = $auction->closeDate;
        $data['type'] = $notification->type;
        $data['user_id'] = $user->id;

        $pusher->trigger('notify-channel2', 'App\\Events\\Notify', $data);
    }
}
