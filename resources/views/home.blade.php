@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <center>
                    <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat mb-3">Allow for Notification</button>
                </center>
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('send.notification') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group mb-3">
                                <label>Body</label>
                                <textarea class="form-control" name="body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Notification</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <script>

        var firebaseConfig = {
            apiKey: "AIzaSyD-8_ImCOLUYVSa0hqok6JNLPF_qwZc7Zo",
            authDomain: "laravel-push-notificatio-86783.firebaseapp.com",
            databaseURL: "laravel-push-notificatio-86783.firebaseio.com",
            projectId: "laravel-push-notificatio-86783",
            storageBucket: "laravel-push-notificatio-86783.appspot.com",
            messagingSenderId: "83366480080",
            appId: "1:83366480080:web:87955c85b726ff6c6e76d5",
            measurementId: "G-LKG5WQSNCB"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function(token) {
                    console.log(token);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ route("save-token") }}',
                        type: 'POST',
                        data: {
                            token: token
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            alert('Token saved successfully.');
                        },
                        error: function (err) {
                            console.log('User Chat Token Error'+ err);
                        },
                    });

                }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
        }

        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });

    </script>
@endsection
