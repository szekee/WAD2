

const app = Vue.createApp({
  data() {
    return {
      skills: '',
      role: [],
      r: '',
      bio: '',
      profilepic: '',
      portfoliolink: '',
      portfoliopath: '',

      facebook: '',
      google: '',
      youtube: '',
      linkedin: '',
    };
  },
  created() {
    axios
    .get("getProfile.php")
    .then((response) => {
      console.log(response.data);
      this.role = response.data.roles;
      this.skills = response.data.skills;
      this.bio = response.data.bio;
      this.profilepic = response.data.profilepic;
      this.portfoliolink = response.data.portfoliolink;
      this.portfoliopath = response.data.portfoliopath;

    })
    .catch((error) => {
      this.status = [{ entry: "There was an error: " + error.message }];
    });
  },
  methods: {
    checkvalue() {
      if (this.role.includes("others")) {
        document.getElementById("role").style.display = "block";
      } else {
        document.getElementById("role").style.display = "none";
      }
    }, 
    addUpdate() {
      param = {skills: this.skills, role: this.role, bio: this.bio, profilepic:this.profilepic, portfoliolink: this.portfoliolink, portfoliopath: this.portfoliopath}

      axios
      .get("AddUpdateProfile.php", {params: param})
      .then((response) => {
        console.log(response.data);
        this.status = response.data;
      })
      .catch((error) => {
        this.status = [{ entry: "There was an error: " + error.message }];
      });
    },
    addprofilepic() {
      console.log(this.profilepic)
      var imginput = document.getElementById('profilepic');
      var file = imginput.files[0];
      compressImg(file, 'sampleprofilepic');
    },
    addportfoliopath() {
      var fileinput = document.getElementById('portfoliopath');
      for (file of fileinput.files) {
        compressImg(file, 'samplegallery')
      }
    }
  },
});

const vm = app.mount("#app");


// https://stackoverflow.com/questions/17586382/how-can-i-move-a-file-to-other-directory-using-javascript
function moveFile(old_path, new_path){
  var object = new ActiveXObject("Scripting.FileSystemObject");
  var file = object.GetFile(old_path);
  file.Move(new_path);
  document.write("File is moved successfully");
}


// https://labs.madisoft.it/javascript-image-compression-and-resizing/
// works if the image is large

const MAX_WIDTH = 320;
const MAX_HEIGHT = 180;
const MIME_TYPE = "image/jpeg";
const QUALITY = 0.7;

function compressImg(file, displayelement) {    

    // gets file
    let blobURL = URL.createObjectURL(file);
    console.log(blobURL)
    let img = new Image();
    img.src = blobURL;
    
    img.onerror = () => {
        URL.revokeObjectURL(this.src);
        console.log("Cannot load image");
    };

    img.onload = () => {
        URL.revokeObjectURL(this.src);
        let [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
        let canvas = document.createElement('canvas');
        canvas.width = newWidth
        canvas.height = newHeight;
        
        ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, newWidth, newHeight);
        canvas.toBlob((blob) => {
            console.log("old = " + file.size)
            console.log("new = " + blob.size)
        }, MIME_TYPE, QUALITY);
        document.getElementById(displayelement).append(canvas);
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

