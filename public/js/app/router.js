/**
 * Created by djzt4 on 16.11.2015.
 */
App.Router = Backbone.Router.extend({
    routers: {
        ''  : 'index'

    },

    index: function(){
        console.log("Index rout!!!");
    }
});