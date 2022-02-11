<? include '../session.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'nav_bar.php'; ?>
  


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

    <!-- Axios Library -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!--Vue-->
    <script src="https://unpkg.com/vue@3.0.11/dist/vue.global.prod.js"></script>   
    
    <!--Javascript for this page-->
    <script defer src="people.js"></script>

    
    
    <title>People</title>


</head>
<body>
  
    <!-- Page Header -->
    <h1 class="p-1 text-center">Find Talents</h1>

    <!--Main-->
    <div class="container-fluid" id="app">
      <div class="row">
    
        <!--Sidebar to search & filter people-->
        <div class="col-md-3 p-3">
          
          <!--Search bar for people-->
          <!-- <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search for people..." aria-label="search" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="searchbtn"><img alt="svgImg" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4Igp3aWR0aD0iMjAiIGhlaWdodD0iMjAiCnZpZXdCb3g9IjAgMCAzMCAzMCIKc3R5bGU9IiBmaWxsOiMwMDAwMDA7Ij48cGF0aCBkPSJNIDEzIDMgQyA3LjQ4ODk5NzEgMyAzIDcuNDg4OTk3MSAzIDEzIEMgMyAxOC41MTEwMDMgNy40ODg5OTcxIDIzIDEzIDIzIEMgMTUuMzk2NTA4IDIzIDE3LjU5NzM4NSAyMi4xNDg5ODYgMTkuMzIyMjY2IDIwLjczNjMyOCBMIDI1LjI5Mjk2OSAyNi43MDcwMzEgQSAxLjAwMDEgMS4wMDAxIDAgMSAwIDI2LjcwNzAzMSAyNS4yOTI5NjkgTCAyMC43MzYzMjggMTkuMzIyMjY2IEMgMjIuMTQ4OTg2IDE3LjU5NzM4NSAyMyAxNS4zOTY1MDggMjMgMTMgQyAyMyA3LjQ4ODk5NzEgMTguNTExMDAzIDMgMTMgMyB6IE0gMTMgNSBDIDE3LjQzMDEyMyA1IDIxIDguNTY5ODc3NCAyMSAxMyBDIDIxIDE3LjQzMDEyMyAxNy40MzAxMjMgMjEgMTMgMjEgQyA4LjU2OTg3NzQgMjEgNSAxNy40MzAxMjMgNSAxMyBDIDUgOC41Njk4Nzc0IDguNTY5ODc3NCA1IDEzIDUgeiI+PC9wYXRoPjwvc3ZnPg=="/></button>
          </div> -->

          <!--Filter options-->
          <button class="btn btn-outline-dark" type="button" @click="filter()">
            Filter By:
          </button>

          <div>
            <ul class="list-unstyled">
              <li class="border-top my-3"></li>

              <!--Role-->
              <li class="mb-1">
                <button class="accordion-button align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#role-collapse" aria-expanded="true">
                  Role
                </button>

                <div class="collapse" id="role-collapse">

                  <div class="form-check" v-for="role in roles">
                    <input class="form-check-input" type="checkbox" v-model="roles_selected" :value="role" :id="role">
                    <label class="form-check-label" :for="role">
                      {{role}}
                    </label>
                  </div>

                </div>
              </li>

              <!--Location-->
              <li class="mb-1">
                <button class="accordion-button align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#location-collapse" aria-expanded="false">
                  Location
                </button>

                <div class="collapse" id="location-collapse">

                  <div class="form-check" v-for="location in locations">
                    <input class="form-check-input" type="checkbox" v-model="locations_selected" :value="location" :id="location">
                    <label class="form-check-label" :for="location">
                      {{location}}
                    </label>
                  </div>

                </div>
              </li>
              
            </ul>
          </div>

        </div>


        <!--Search/Filter Results-->
        <div class="col p-3">

          <div class="row">

            <div class="col-6 col-sm-4 col-lg-3 mb-3" v-for="profile in profiles" >
              <div class="card" :id="profile.userid" onclick="getDetails(this.id)" style="height: 450px; overflow: hidden;">
                <img :src="profile.profilepic" class="card-img-top pt-3" alt="...">
                <div class="card-body">
                  <h4 class="card-title">{{profile.name}}</h4>
                  <h5 class="card-subtitle text-muted">{{profile.roles.join(', ')}}</h5>
                  <p class="card-text mt-2">{{profile.country}}</p>
                </div>
              </div>
            </div>


          </div>

        </div>


      </div>
    </div>



</body>
</html>
