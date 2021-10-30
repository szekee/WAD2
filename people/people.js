
const app = Vue.createApp({
    data() {
        return {
            profiles: [],
            roles: [],
            locations: [],
            role: "",
            location: "",
            roles_selected: [],
            locations_selected: [],
        }
    },
    created() {
        axios
        .all([
            axios.get('getProfiles.php'),
            axios.get('getRoles.php'),
            axios.get('getLocations.php'),
        ])
        .then(axios.spread((response, response1, response2) => {
            this.profiles = response.data;
            this.roles = response1.data;
            this.locations = response2.data;
        }))
        .catch((error) => {
            let errorurl = error.toJSON().config.url;
            console.log(error.toJSON());
            console.log(errorurl);
        });
    },
    methods: {
        filter() {
            r = this.roles_selected.join('; ');
            l = this.locations_selected.join('; ');

            param = {roles: r, locations: l}

            axios
                .get("getFilteredProfiles.php", {params: param})
                .then((response) => {
                    this.profiles = response.data;
                })
                .catch((error) => {
                    console.log(error.message)
            });
        }
    }
});

// app.component('filter-option', {
//     data() {
//         return {
//             roles_selected: [],
//             locations_selected: [],
//         }
//     },
//     props: ['id', 'subject', 'entry', 'mood'],
//     template: `    
//     <div class="form-check">
//         <input class="form-check-input" type="checkbox" v-model="roles_selected" :value="role" id="flexCheckDefault">
//         <label class="form-check-label" for="flexCheckDefault">
//             {{role}}
//         </label>
//     </div>`
// });

const vm = app.mount("#app");
