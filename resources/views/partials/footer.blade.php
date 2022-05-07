<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<footer class="footer text-center">
    <span class="text-muted d-block d-sm-inline-block" style="font-family: Tajawal">جميع الحقوق محفوضة لدى © <a href="" target="_blank"> Babor
        </a>2022</span>
</footer>
<!-- page-body-wrapper ends -->
</div>




<!-- plugins:js -->
<!-- endinject -->

<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script>
    $(document).ready(function() {
                $('.previewImage').change(function() {
            for (var i = 0; i < $(this)[0].files.length; i++) {
                $(".previewFrames").append(
                    `<button type="button" class="btn close" id="btn-${i}"
                                data-bs-dismiss="alert" style="position: absolute; font-size:30px; padding:0;">&times;</button>`
                );
                $(".previewFrames").append('<img src="' + window.URL.createObjectURL(this.files[
                        i]) +
                    '" width="100px" height="100px" style="overflow:auto;"/>');
                $(`#btn-${i}`).click(function() {
                    $('.previewFrames').val(null);
                });
            }
        });
        // $('#nav-tab a[data-bs-toggle="tab" href="#{{ old('tab') }}"]').tab('show');




    });
</script>
<script src="{{ @asset('assets/js/jQuery.min.js') }}"></script>
<script src="{{ @asset('assets/js/multistep-form.js') }}"></script>
<script src="{{ @asset('assets/js/template.js') }}"></script>
<script src="{{ @asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ @asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ @asset('assets/js/carImagesSlider.js') }}"></script>
<script src="{{ @asset('assets/vendors/base/vendor.bundle.base.js') }}"></script>
<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>


<script>
    const beamsClient = new PusherPushNotifications.Client({
        instanceId: 'a3a5a14b-1e7d-45fd-a7e1-8baf2fea909c',
    });

    beamsClient.start()
        .then(() => beamsClient.addDeviceInterest('hello'))
        .then(() => console.log('Successfully registered and subscribed!'))
        .catch(console.error);
</script>

<script type="module">

    // Import the functions you need from the SDKs you need

    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.7.0/firebase-app.js";

    import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.7.0/firebase-analytics.js";

    // TODO: Add SDKs for Firebase products that you want to use

    // https://firebase.google.com/docs/web/setup#available-libraries


    // Your web app's Firebase configuration

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

    // const app = initializeApp(firebaseConfig);
    //
    // const analytics = getAnalytics(app);

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


</script>


{{--FCM Key --}}
{{--AAAAJ4f0eC4:APA91bF8Fkh9F6WduAQFEFl3aQF98UdRaDDTQczwa8YTdJzITbxGxYomUU2S8w0swHCqdePytZCHJDEEwOch8Kyb2OVSHSnJCPNAMd-kl5j1u5km91CBXwiA7Ek6w3JChNDxIiUT4EWL--}}
{{--    send key --}}
{{--169784670254--}}
</body>

</html>
