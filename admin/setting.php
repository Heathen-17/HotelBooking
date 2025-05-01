<?php
    require('inc/essential.php');
    adminLogin();
    session_regenerate_id(true);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <link rel="stylesheet" href="common.css">
    <?php require('inc/link.php');?> 
</head>

<body class="bg-light">
    <?php require('inc/header.php')?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Settings</h3>
                <!--General Setting section -->
                <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">General Setting</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm " data-bs-toggle="modal" data-bs-target="#general-s">
                        <i class="bi bi-pencil"></i>Edit
                        </button>

                    </div>
                    <h6 class="card-subtitle mb-1 fw-bold">Site title</h6>
                    <p class="card-text" id="site_title"></p>
                    <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                    <p class="card-text" id="site_about"></p>
                   
                </div>
                </div>

                 <!--General Setting Modal-->
                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form>
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5">General Setting</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Site Title</label>
                            <input type="text" name ="site_title" id="site_title_inp" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">About Us</label>
                            <textarea  name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="site_title.value= general_data.site_title, site_about.value= general_data.site_about" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                            <button type="button" onclick="upd_general(site_title.value, site_about.value)" class="btn btn-primary">Submit</button>
                        </div>
                        </div>

                    </form>
                    </div>
                </div>

                <!--Contact detail section-->
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Contact Setting</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm " data-bs-toggle="modal" data-bs-target="#contacts-s">
                        <i class="bi bi-pencil"></i>Edit
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                            <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                            <p class="card-text" id="address"></p>
                            </div>
                        
                        <div class="mb-4">
                            <h6 class="card-subtitle mb-1 fw-bold">GoogleAMap</h6>
                            <p class="card-text" id="gmap"></p>
                        </div>
                        <div class="mb-4">
                            <h6 class="card-subtitle mb-1 fw-bold">Phone Number</h6>
                            <p class="card-text">
                                <i class="bi bi-telephone-outbound-fill me-1"></i>
                                <span id="pn1"></span>
                            </p>
                            <p class="card-text">
                                <i class="bi bi-telephone-outbound-fill me-1"></i>
                                <span id="pn2"></span>
                            </p>
                        </div>
                        <div class="mb-4">
                            <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                            <p class="card-text" id="email"></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="mb-4">
                        <h6 class="card-subtitle mb-1 fw-bold">Socail links</h6>
                        <p class="card-text mb-1">
                            <i class="bi bi-facebook me-1"></i>
                            <span id="fb"></span>
                        </p>
                        <p class="card-text">
                            <i class="bi bi-instagram me-1"></i>
                            <span id="insta"></span>
                        </p>
                        <p class="card-text">
                            <i class="bi bi-twitter me-1"></i>
                            <span id="twi"></span>
                        </p>
                    </div>

                    <div class="mb-4">
                        <h6 class="card-subtitle mb-1 fw-bold">Location</h6>
                        <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                    </div>
                    </div>
                </div>
                </div>
                </div>

                 <!--Contact Details Modal-->
                 <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form id="contacts_s_form">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5">Contact Setting</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluidf">
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="mb-3">
                                            <label class="form-label fw-bold">Address</label>
                                            <input type="text" name ="address" id="address_inp" class="form-control shadow-none" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Google Map Link</label>
                                            <input type="text" name ="gmap" id="gmap_inp" class="form-control shadow-none" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Phone Number( with country code)</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">@</span>
                                              <input type="text" name="pn1" id="pn1_inp" class="form-control shadow-none" required>
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">@</span>
                                              <input type="text" name="pn2" id="pn2_inp" class="form-control shadow-none" required>
                                            </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Email</label>
                                            <input type="text" name ="email" id="email_inp" class="form-control shadow-none" required>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                    <div class="mb-3">
                                            <label class="form-label fw-bold">Social Links</label>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text"> <i class="bi bi-facebook me-1"></i></span>
                                              <input type="text" name="fb" id="fb_inp" class="form-control shadow-none" required>
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text"><i class="bi bi-instagram me-1"></i></span>
                                              <input type="text" name="insta" id="insta_inp" class="form-control shadow-none" required>
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text"><i class="bi bi-twitter me-1"></i></span>
                                              <input type="text" name="twi" id="twi_inp" class="form-control shadow-none" required>
                                            </div>
                                            <div class="mb-3">
                                            <label class="form-label fw-bold">Location</label>
                                            <input type="text" name ="iframe" id="iframe_inp" class="form-control shadow-none" required>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="contacts_inp(contacts_data)" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit"  class="btn btn-primary">Submit</button>
                        </div>
                        </div>

                    </form>
                    </div>
                </div>
        </div>
    </div>




    <?php require('inc/script.php')?>

    <!-- agax -->
    <script>
    let general_data,   contacts_data;
    // let site_about = document.getElementById('site_about');
    // let site_title = document.getElementById('site_title');
    let general_s_form = document.getElementById('general_s_form');
    let site_about_inp = document.getElementById('site_about_inp');
    let site_title_inp = document.getElementById('site_title_inp');

    let contacts_s_form = document.getElementById('contacts_s_form');


    function get_general() 
    {
        // let site_about = document.getElementById('site_about');
        // let site_title = document.getElementById('site_title');
        // let site_about_inp = document.getElementById('site_about_inp');
        // let site_title_inp = document.getElementById('site_title_inp');

        // let general_s_form = document.getElementById('contacts_s_form');


        let xhr = new XMLHttpRequest();
        xhr.open("POST", "agax/settings_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            // general_data = this.responseText;
            // console.log(general_data);

            general_data = JSON.parse(this.responseText);
            site_title.innerText = general_data.site_title;
            site_about.innerText = general_data.site_about;

            site_about_inp.value = general_data.site_about;
            site_title_inp.value = general_data.site_title;
        }

        xhr.send('get_general');
    }

   
    function upd_general(site_title_val, site_about_val)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "agax/settings_crud.php", true);                                       //xhr object
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');          //form header though POST
        xhr.onload = function () {
            var myModal = document.getElementById('general-s');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            // console.log(this.responseText);

            if(this.responseText==1)
            {
                console.log("data updated");
                get_general();
            }
            else{
                console.log("No changes Needed");
            }
        }

        xhr.send('site_title='+site_title_val+'&site_about='+site_about_val+'&upd_general');
    }



    function get_contacts() 
    {
        let contacts_p_id =['address','gmap','pn1','pn2','email','fb','insta','twi' ];
        let iframe = document.getElementById('iframe');


        let xhr = new XMLHttpRequest();
        xhr.open("POST", "agax/settings_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            contacts_data = JSON.parse(this.responseText);
            // console.log(contacts_data)
            contacts_data = Object.values(contacts_data)            //extract values
            
            for(i=0; i<contacts_p_id.length;i++){
                document.getElementById(contacts_p_id[i]).innerText = contacts_data[i+1];
            }
            iframe.src = contacts_data[9];
            contacts_inp(contacts_data);
            }
        xhr.send('get_contacts');
    }


    function contacts_inp(data) {
        let contacts_inp_id =['address_inp','gmap_inp','pn1_inp','pn2_inp','email_inp','fb_inp','insta_inp','twi_inp','iframe_inp'];

        for(i=0; i<contacts_inp_id.length;i++){
            document.getElementById(contacts_inp_id[i]).value = data[i+1];   
        }
    }


    contacts_s_form.addEventListener('submit',function(e){
        e.preventDefault();
        upd_contacts();
    })




    function upd_contacts(){
        let index = ['address','gmap','pn1','pn2','email','fb','insta','tw','iframe'];
        let contacts_inp_id =['address_inp','gmap_inp','pn1_inp','pn2_inp','email_inp','fb_inp','insta_inp','twi_inp','iframe_inp'];

        let data_str="";
        for(i=0; i<index.length;i++){
            data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';
        }
        console.log(data_str);
        data_str += "upd_contacts";
        console.log(data_str);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "agax/settings_crud.php", true);                                       //xhr object
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 

        xhr.onload = function(){
            console.log();
            var myModal = document.getElementById('contacts-s');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            if(this.responseText==1)
            {
                console.log("data updated");
                get_contacts();
            }
            else{
                console.log("No changes Needed");
            }
        
        }
        xhr.send(data_str);
    }
    window.onload = function () {
        get_general();
        get_contacts();
    }
</script>

</body>

</html>
