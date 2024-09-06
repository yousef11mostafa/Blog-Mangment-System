
import { createStore } from "vuex"
import auth from './auth/index.js'
import user from './user/index.js'
import posts from './posts/index.js'
import comments from './comments/index.js'
import front from './front/index.js'

const store= createStore({
      state:{},
      getters:{
      },
      mutations:{
      },
      actions:{
      },
      modules:{
        auth,
        user,
        posts,
        comments,
        front,

      },
});


export default store;
