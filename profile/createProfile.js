



const app = Vue.createApp({
  data() {
    return {

      skills: '',

      role: [],
      r: '',

      bio: '',

      youtubelink: '',

      profilepic: '',
      portfoliolink: '',
      portfoliopath: [],

      facebook: '',
      instagram: '',
      youtube: '',
      pinterest: '',
    };
  },
  created() {
    axios
    .get("getProfile.php")
    .then((response) => {
      if (response.data != "No profile found") {
        this.role = response.data.roles;
        this.skills = response.data.skills;
  
        if (response.data.videoid != '') {
          this.youtubelink = 'www.youtube.com/watch?v=' + response.data.videoid;
        }
        this.bio = response.data.bio;
  
        this.profilepic = response.data.profilepic;
        this.portfoliolink = response.data.portfoliolink;
        this.portfoliopath = response.data.portfoliopath;
  
        this.facebook = response.data.facebook
        this.instagram = response.data.instagram;
        this.youtube = response.data.youtube;
        this.pinterest = response.data.pinterest;
      }
    })
    .catch((error) => {
      this.status = [{ entry: "There was an error: " + error.message }];
    });
  },
  computed: {
    isRequired: function () {
      return this.profilepic == '';
    },
  },
  methods: {
    deleteRole(role_selected) {
      this.role.splice(this.role.indexOf(role_selected), 1);
    },
    addprofilepic() {
      var imginput = document.getElementById('profilepic');
      var file = imginput.files[0];

      //compress file
      compressImg(file, 'sampleprofilepic', 'processed_profilepic');
      document.getElementById('sampleprofilepic').style = 'display: block';
    },
    addportfoliopath() {
      // check if too many files
      var gallerypics = document.getElementById('portfoliopath').files;
      if (gallerypics.length > 8) {
        alert("You can only upload maximum of 8 images into Photo Gallery");
        $ok = false;
      } else {
        $ok = true;
      }
      // display
      if ($ok) {
        if (document.getElementById('samplegallery' + '_basket') !== null) {
          document.getElementById('samplegallery' + '_basket').remove()
          document.getElementById('processed_gallery').remove()
        }
        var fileinput = document.getElementById('portfoliopath');
  
        // compress file
        for (file of fileinput.files) {
          compressImg(file, 'samplegallery', 'processed_gallery');
        }
        document.getElementById('samplegallery').style = 'display: block';
      }
      
    }
  },
});

const vm = app.mount("#app");




// https://labs.madisoft.it/javascript-image-compression-and-resizing/
// compresses if the image is large enough

const MAX_WIDTH = 320;
const MAX_HEIGHT = 180;
const MIME_TYPE = "image/jpeg";
const QUALITY = 0.7;

function compressImg(file, displayelement, processelement) {    

    var form = document.getElementById('form');

    // gets file
    let blobURL = URL.createObjectURL(file);
    let img = new Image();
    img.src = blobURL;
    
    img.onerror = () => {
        URL.revokeObjectURL(this.src);
        console.log("Cannot load image");
    };

    img.onload = () => {
        URL.revokeObjectURL(this.src);
        let [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);

        if (displayelement == 'sampleprofilepic') { 
          // profile pic has somthing so replace
          if (document.getElementById(displayelement + '_canvas') !== null) {
            document.getElementById(displayelement + '_canvas').remove()

            let canvas = document.createElement('canvas');
            canvas.id = displayelement + '_canvas';
            canvas.width = newWidth;
            canvas.height = newHeight;
            
            // display
            ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            document.getElementById(displayelement).append(canvas);
  
            // process to send form
            var compressed = canvas.toDataURL();

            document.getElementById(processelement).value = compressed;

          // profile pic has nothing so add
          } else {
            let canvas = document.createElement('canvas');
            canvas.id = displayelement + '_canvas';
            canvas.width = newWidth;
            canvas.height = newHeight;
            
            // display
            ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            document.getElementById(displayelement).append(canvas);

            // process to add to form
            var compressed = canvas.toDataURL();

            var newinput = document.createElement("input");
            newinput.type = 'hidden';
            newinput.id = processelement;
            newinput.name = processelement;
            newinput.value = compressed; // put result from canvas into new hidden input
            form.appendChild(newinput);

          }

          
        } else { 
          if (document.getElementById(displayelement + '_basket') === null) {
            // else if gallery basket has nothing so add new
            var basket = document.createElement("div");
            basket.id = displayelement + '_basket';
            document.getElementById(displayelement).append(basket);

            let canvas = document.createElement('canvas');
            canvas.width = newWidth;
            canvas.height = newHeight;
            
            // display
            ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);

            document.getElementById(displayelement + '_basket').append(canvas);


            // process to add to form
            var compressed = canvas.toDataURL();

            var newinput = document.createElement("input");
            newinput.type = 'hidden';
            newinput.id = processelement;
            newinput.name = processelement;
            newinput.value = compressed; // put result from canvas into new hidden input
            form.appendChild(newinput);

          } else {
            // if gallery basket has sth so continue adding
            let canvas = document.createElement('canvas');
            canvas.width = newWidth;
            canvas.height = newHeight;
            
            // display
            ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);

            document.getElementById(displayelement + '_basket').append(canvas);

            // process to send to form
            var compressed = canvas.toDataURL();

            let old_string = document.getElementById(processelement).value;
            document.getElementById(processelement).value = old_string + " " + compressed;
          }
        }


    }
}

function calculateSize(img, maxWidth, maxHeight) {
  let width = img.width;
  let height = img.height;

  // calculate the width and height, constraining the proportions
  if (width > height) {
    if (width > maxWidth) {
      height = Math.round((height * maxWidth) / width);
      width = maxWidth;
    }
  } else {
    if (height > maxHeight) {
      width = Math.round((width * maxHeight) / height);
      height = maxHeight;
    }
  }
  return [width, height];
}

