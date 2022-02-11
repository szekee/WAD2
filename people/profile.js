// https://stackoverflow.com/questions/12049620/how-to-get-get-variables-value-in-javascript
var $_GET = {};
if(document.location.toString().indexOf('?') !== -1) {
    var query = document.location
                   .toString()
                   // get the query string
                   .replace(/^.*?\?/, '')
                   // and remove any existing hash string (thanks, @vrijdenker)
                   .replace(/#.*$/, '')
                   .split('&');
    for(var i=0, l=query.length; i<l; i++) {
       var aux = decodeURIComponent(query[i]).split('=');
       $_GET[aux[0]] = aux[1];
    }
}
//get the 'index' query parameter
const $id = $_GET['id'];

// populate data in profile with vue
const app = Vue.createApp({
  data() {
    return {
      name: '',
      email: '',
      address: '',
      phone: '',
      country: '',

      skills: '',
      role: [],
      r: '',
      bio: '',
      videoid: '',
      profilepic: '',
      portfoliolink: '',
      portfoliopath1: '',
      portfoliopath: [],
      src: '',

      facebook: '',
      instagram: '',
      youtube: '',
      pinterest: '',

    };
  },
  created() {
    axios
    .get("getViewProfile.php?t=" + Date.now() + "&id=" + $_GET['id'])
    .then((response) => {
      this.name = response.data.name;
      this.email = response.data.email;
      this.address = response.data.address;
      this.country = response.data.country;
      this.phone = response.data.phone;

      this.role = response.data.roles;
      this.skills = response.data.skills.split(',');
      this.bio = response.data.bio;
      this.videoid = response.data.videoid;
      this.profilepic = response.data.profilepic;
      this.portfoliolink = response.data.portfoliolink;

      this.portfoliopath1 = response.data.portfoliopath[0];
      this.portfoliopath = response.data.portfoliopath.slice(1);

      this.facebook = response.data.facebook
      this.instagram = response.data.instagram;
      this.youtube = response.data.youtube;
      this.pinterest = response.data.pinterest;
    })
    .catch((error) => {
      this.status = [{ entry: "There was an error: " + error.message}];
    });
  },

});

app.component('carousel', {
  props: ['src', 'portfoliopath', 'portfoliopath1'],
  template: `    
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"> 
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators"  class="active" data-bs-slide-to="0"></button>
        <button v-for="(src, idx) in portfoliopath" type="button" data-bs-target="#carouselExampleIndicators" :data-bs-slide-to="idx + 1"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="2000">
            <img :src="portfoliopath1" class="d-block" alt="...">
        </div>
        <div v-for="src in portfoliopath" class="carousel-item" data-bs-interval="2000">
            <img :src="src" class="d-block" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
  </div>`
});

const vm = app.mount("#app");



//youtube video api
// 1. This code loads the IFrame Player API code asynchronously.
setTimeout(function(){ 
  var tag = document.createElement('script');
  
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

}, 1000);

  
// 2. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
var id = document.getElementById('youtubevideo').value;

player = new YT.Player('player', {
  width: '100%',
  videoId: id,
  playerVars: {
  'playsinline': 1
  }
});
}


