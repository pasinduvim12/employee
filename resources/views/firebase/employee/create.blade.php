@extends('firebase.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">

                        <h4>
                            Add employee
                            <a href="{{url('employees')}}" class="btn btn -sm btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('add-employees')}}" method="POST">
                            @csrf


                            <div class="row g-3">
                                <div class="col">
                                    <label>Full name</label>
                                    <input type="text" name="fname" placeholder="Full name" class="form-control">
                                </div>
                                <div class="alert-danger"> {{ $errors->first('fname') }} </div>
                            </div>


                            <div class="form grroup mb-3">
                                <label> Mobile number </label>
                                <input type="number" name="phone" class="form-control" />
                            </div>
                            <div class="alert-danger"> {{ $errors->first('phone') }} </div>

                            <div class="form grroup mb-3">
                                <label>ID </label>
                                <input type="text" name="Eid" class="form-control" />
                            </div>
                            <div class="alert-danger"> {{ $errors->first('Eid') }} </div>


                            <div class="form grroup mb-3">
                                <select class="form-select" name="Position" aria-label="Default select example">
                                    <option  selected>Select your Position</option>
                                    <option>associate software engineer </option>
                                    <option>Senior software engineer</option>
                                    <option >Trainee software engineer</option>
                                    <option >Trainee QA engineer</option>
                                    <option >Trainee Web developer</option>
                                </select>
                            </div>
                            <div class="alert-danger"> {{ $errors->first('Position') }} </div>

                            <div class="form grroup mb-5">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>




                    </div>
                    <div class="col">
                        <div class="contentarea">

                            <div class="camera">
                                <video id="video">Video stream not available.</video>
                            </div>
                            <div><button id="startbutton">Take photo</button></div>
                            <canvas id="canvas"></canvas>
                            <div class="output">
                                <img id="photo" name="image" alt="The screen capture will appear in this box.">
                            </div>
                        </div>
                    </div>

                    <div class="form grroup mb-5">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>







                </div>
            </div>
        </div>
        <!-- <div class="social d-flex text-center">
<a href="#" class="px-2 py-1 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Login INVENTable</a>

</div> -->
    </div>
</div>
</div>









</body>

</html>


<script>
    function removeText() {
        var parent = document.getElementById('photo');
        document.getElementById("photo").innerHTML = 'photo </b>';
    }
    /* JS comes here */
    (function() {

        var width = 320; // We will scale the photo width to this
        var height = 0; // This will be computed based on the input stream

        var streaming = false;

        var video = null;
        var canvas = null;
        var photo = null;
        var startbutton = null;

        function startup() {
            video = document.getElementById('video');
            canvas = document.getElementById('canvas');
            photo = document.getElementById('photo');
            startbutton = document.getElementById('startbutton');

            navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: false
                })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(err) {
                    console.log("An error occurred: " + err);
                });

            video.addEventListener('canplay', function(ev) {
                if (!streaming) {
                    height = video.videoHeight / (video.videoWidth / width);

                    if (isNaN(height)) {
                        height = width / (4 / 3);
                    }

                    video.setAttribute('width', width);
                    video.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                    canvas.setAttribute('height', height);
                    streaming = true;
                }
            }, false);

            startbutton.addEventListener('click', function(ev) {
                takepicture();
                ev.preventDefault();
            }, false);

            clearphoto();
        }


        function clearphoto() {
            var context = canvas.getContext('2d');
            context.fillStyle = "#AAA";
            context.fillRect(0, 0, canvas.width, canvas.height);

            var data = canvas.toDataURL('image/png');
            photo.setAttribute('src', data);
        }

        function takepicture() {
            var context = canvas.getContext('2d');
            if (width && height) {
                canvas.width = width;
                canvas.height = height;
                context.drawImage(video, 0, 0, width, height);

                var data = canvas.toDataURL('image/png');
                photo.setAttribute('src', data);
            } else {
                clearphoto();
            }
        }

        window.addEventListener('load', startup, false);
    })();
</script>




</form>

</div>
</div>
</div>
</div>
</div>

@endsection