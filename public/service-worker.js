importScripts("https://js.pusher.com/beams/service-worker.js");
import * as PusherPushNotifications from "@pusher/push-notifications-web";


const beamsClient = new PusherPushNotifications.Client({
    instanceId: 'a3a5a14b-1e7d-45fd-a7e1-8baf2fea909c',
});

beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('hello'))
    .then(() => console.log('Successfully registered and subscribed!'))
    .catch(console.error);


// Your web app's Firebase configuration
//
// For Firebase JS SDK v7.20.0 and later, measurementId is optional

const firebaseConfig = {

    apiKey: "AIzaSyD1Kdn9EkXIZeoVMfWMzZWag65v65g86Nc",

    authDomain: "babor-2022.firebaseapp.com",

    projectId: "babor-2022",

    storageBucket: "babor-2022.appspot.com",

    messagingSenderId: "169784670254",

    appId: "1:169784670254:web:a8022accfb60bc9cda07bf",

    measurementId: "G-ZZ53Y360M8"

};


// Initialize Firebase

const app = initializeApp(firebaseConfig);

const analytics = getAnalytics(app);

// Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    //firebase.analytics();
    const messaging = firebase.messaging();
    messaging
        .requestPermission()
        .then(function () {
//MsgElem.innerHTML = "Notification permission granted."
            console.log("Notification permission granted.");

            // get the token in the form of promise
            return messaging.getToken()
        })
        .then(function(token) {
            // print the token on the HTML page
            console.log(token);



        })
        .catch(function (err) {
            console.log("Unable to get permission to notify.", err);
        });

    messaging.onMessage(function(payload) {
        console.log(payload);
        var notify;
        notify = new Notification(payload.notification.title,{
            body: payload.notification.body,
            icon: payload.notification.icon,
            tag: "Dummy"
        });
        console.log(payload.notification);
    });

    //firebase.initializeApp(config);
    var database = firebase.database().ref().child("/users/");

    database.on('value', function(snapshot) {
        renderUI(snapshot.val());
    });

    // On child added to db
    database.on('child_added', function(data) {
        console.log("Comming");
        if(Notification.permission!=='default'){
            var notify;

            notify= new Notification('CodeWife - '+data.val().username,{
                'body': data.val().message,
                'icon': 'bell.png',
                'tag': data.getKey()
            });
            notify.onclick = function(){
                alert(this.tag);
            }
        }else{
            alert('Please allow the notification first');
        }
    });

    self.addEventListener('notificationclick', function(event) {
        event.notification.close();
    });
