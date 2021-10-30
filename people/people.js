


const app = Vue.createApp({
    data() {
        return {
            profiles: [],
            roles: [],
            locations: [],
        }
    },
    created() {
        axios
        .all([
            axios.get('getProfiles.php'), 
            axios.get('getRoles.php'),
            axios.get('getLocations.php'),
        ])
        .then(axios.spread((response1, response2, response3) => {
            this.profiles = response1.data;
            this.roles = response2.data;
            this.locations = response3.data;
        }))
        .catch((error) => {
            let errorurl = error.toJSON().config.url;
            console.log(error.toJSON());
            console.log(errorurl);
        });

    },
    methods: {
        filter() {
            this.profiles = []
        }
    }
});

const vm = app.mount("#app");