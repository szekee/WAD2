<?php
    include "nav_bar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS File for BootStrap-->
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
        crossorigin="anonymous"
      />
  
      <!--Javascript File for BootStrap-->
      <script
        defer
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"
      ></script>
  
      <!-- Axios Library here -->
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  
      <!--Vue-->
      <script src="https://unpkg.com/vue@3.0.11/dist/vue.global.prod.js"></script>  

      <!--Javascript-->
      <script defer src="createProfile.js"></script>

      <style>
            .required:after {
                content:" *";
                color: red;
            }
      </style>

    <title>Profile</title>
</head>
<body>

<!-- Page Header -->
<h1 class="p-3 text-center">Profile Details</h1>

<!--Edit Alert Status Bar-->

<?php
if (isset($_GET['edit'])) {
    if ($_GET['edit'] == 'success') {
        echo "
        <div class='alert alert-success mx-3' role='alert'>
            Profile successfully updated! Go to Profile to view changes!
        </div>";
    } else {
        echo "
        <div class='alert alert-danger mx-3' role='alert'>
            Profile failed to update! <br>
            {$_GET['error']}
        </div>";
    }
}
?>

<!-- Form -->
<div id="app" class="container-fluid bg-light text-dark p-5">
    <form id="form" action="AddUpdateProfile.php" method="post" enctype="multipart/form-data">
        
        <div class="row p-3">
            <h3>Portfolio Details</h3>
        </div>

        <div class="row p-3">
            <div class="col">
                <label class="required" for="role">Role</label>
                <select name="role[]" v-model="role" class="form-select" required multiple>
                    <option disabled>Select one or more options</option>
                    <option value="Photographer">Photographer</option>
                    <option value="Videographer">Videographer</option>
                    <option value="Actor">Actor</option>
                    <option value="Music Producer">Music Producer</option>
                    <option value="Graphic Designer">Graphic Designer</option>
                    <option value="Film Maker">Film Maker</option>
                    <option value="Model">Model</option>
                    <option value="Make-up Artist">Make-up Artist</option>
                    <option value="Animation">Animator</option>
                    <option value="Content Writing">Content Writing</option>
                </select>
            </div>
            <div v-if="role != []" class="col-sm">
                Roles Chosen: 
                <ul class="list-group">
                    <li v-for="r in role" class="list-group-item d-flex justify-content-between">
                        {{r}}
                        <button @click="deleteRole(r)" type="button" class="btn-close"></button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row p-3">
            <div class="col">
                <label class="required" for="bio">Bio</label>
                <input required type="text" class="form-control" v-model='bio' id="bio" name="bio" placeholder="A short description of yourself">
            </div>
        </div>

        <div class="row p-3">
            <div class="col">
                <label class="required" for="skills">Skills</label>
                <input required type="text" class="form-control" v-model="skills" id="skills" name="skills" placeholder="Eg. Photography, Videography">
            </div>
        </div>

        <div class="row p-3">
            <div class="col">
                <label for="portfoliolink">Link to Portfolio</label>
                <input type="text" class="form-control" v-model="portfoliolink" id="portfoliolink" name="portfoliolink" placeholder="Eg. www.myonlineportfolio.com">
            </div>
        </div>

        <div class="row p-3">
            <div class="col">
                <label for="youtubelink">Link to Youtube Video</label>
                <input type="text" class="form-control" :value="youtubelink" id="youtubelink" name="youtubelink" placeholder="Eg. www.youtube.com/watch?v=videoid">
            </div>
        </div>

        <div class="row p-3">
            <div class="col">
                <label class="required" for="profilepic">Profile Picture (Image size should be less than 8MB)</label>
                <input :required="isRequired" type="file" accept="image/*" class="form-control" @change="addprofilepic" id="profilepic" name="profilepic1">
                <div v-if="profilepic != ''" class="pt-2">
                    Old Image:<br><img :src="profilepic">
                </div>
                <input type="hidden" name="profilepic" :value="profilepic">
                <div class="p-2" id="sampleprofilepic" style="display: none">
                    New Image:<br>
                </div>
            </div>        
        </div>

        <div class="row p-3">
            <div class="col">
                <label for="portfoliopath" class="form-label">Photo Gallery</label>
                <input type="file" accept="image/*" class="form-control" @change="addportfoliopath" id="portfoliopath" multiple />
                <div v-if="portfoliopath != []" class="pt-2 col">
                    Old Gallery:<br>
                    <img v-for="src in portfoliopath" :src="src">
                </div>
                <input type="hidden" name="portfoliopath" :value="portfoliopath[0]">
                <div class="p-2 col" id="samplegallery" style="display: none">
                    New Gallery:<br>
                </div>
            </div>
        </div>

        <hr>

        <div class="row p-3">
            <h3>Contact Details</h3>
        </div>

        <div class="row p-3">
            <div class="col">
                <label for="facebook">Facebook Profile Link</label>
                <input type="text" class="form-control" v-model="facebook" id="facebook" name="facebook" placeholder="Eg. www.facebook.com/your_fb_id">
            </div>
        </div>

        <div class="row p-3">
            <div class="col">
                <label for="instagram">Instagram Profile Link</label>
                <input type="text" class="form-control" v-model="instagram" id="instagram" name="instagram" placeholder="Eg. www.instagram.com/username">
            </div>
        </div>

        <div class="row p-3">
            <div class="col">
                <label for="youtube">Youtube Channel Link</label>
                <input type="text" class="form-control" v-model="youtube" id="youtube" name="youtube" placeholder="Eg. www.youtube.com/channel/channelid">
            </div>
        </div>

        <div class="row p-3">
            <div class="col">
                <label for="pinterest">Pinterest Profile Link</label>
                <input type="text" class="form-control" v-model="pinterest" id="pinterest" name="pinterest" placeholder="Eg. www.pinterest.com/username">
            </div>
        </div>

        <hr>
        
        <div class="row p-3">
            <div class="col">
                <button class="btn btn-primary" name="submit" type="submit" value="submit">Submit</button>
            </div>
        </div>
        

    </form>

</div>

    
</body>
</html>