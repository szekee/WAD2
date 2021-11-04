//youtube video api
// 1. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 2. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    width: '100%',
    videoId: 'M7lc1UVf-VE',
    playerVars: {
      'playsinline': 1
    }
  });
}

const setBg = () => {
  const randomColor = Math.floor(Math.random() * 16777215).toString(16);
  document.querySelector(".avatar").style.borderColor = "#" + randomColor;
};

setBg();
setInterval(() => setBg(), 250);

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
      profilepic: '',
      portfoliolink: '',
      portfoliopath: '',
    };
  },
  created() {
    axios
    .get("getProfile.php")
    .then((response) => {
      console.log(response.data);
      this.name = response.data.name;
      this.email = response.data.email;
      this.address = response.data.address;
      this.country = response.data.country;
      this.phone = response.data.phone;

      this.role = response.data.roles;
      this.skills = response.data.skills.split(',');
      this.bio = response.data.bio;
      this.profilepic = response.data.profilepic;
      this.portfoliolink = response.data.portfoliolink;
      this.portfoliopath = response.data.portfoliopath;
    })
    .catch((error) => {
      this.status = [{ entry: "There was an error: " + error.message}];
    });
  },
});
const vm = app.mount("#app");
