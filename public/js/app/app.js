/**
 * Created by djzt on 16.11.2015.
 */

(function(){
    window.App = {
        Models:         {},
        Collections:    {},
        Views:          {},
        Router:         {}
    };

    window.vent = _.extend({}, Backbone.Events);

    App.template = function(tpl){
        return _.template(tpl);
    }
}());