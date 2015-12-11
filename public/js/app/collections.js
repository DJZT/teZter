/**
 * Created by djzt4 on 16.11.2015.
 */
App.Collections.Users = Backbone.Collection.extend({
    model   : App.Models.User,
    url     : '/rest/users'
});