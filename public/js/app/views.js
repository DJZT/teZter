/**
 * Created by djzt4 on 16.11.2015.
 */
App.Views.App = Backbone.View.extend({
    initialize: function(){
        var addUser = new App.Views.CreateUser({collection: App.users});
        var allUsers = new App.Views.UsersTable({collection: App.users}).render();

    }
});


App.Views.CreateUser = Backbone.View.extend({
    el: '#createForm',
    events: {
        'submit': 'addUser'
    },

    addUser: function(event){
        event.preventDefault();

        var newUser = this.collection.create({
            firs_name: this.$('#first_name').val(),
            second_name: this.$('#second_name').val(),
            email: this.$('#email').val(),
            password: this.$('#password').val()
        }, {wait: true});

    }
});


App.Views.UsersTableBody = Backbone.View.extend({
    tagName:    'tbody',
    render: function(){
        this.collection.each(this.addOne, this);

        return this;
    },
    addOne: function(user){
        console.log(user.toJSON());
        var rowUser = new App.Views.UserRow({model:user});
        rowUser.render();
        console.log(rowUser.render().el);
        this.$el.append(rowUser.render().el);



    }
});


App.Views.UserRow = Backbone.View.extend({
    tagName: 'tr',
    template: function(){},
    initialize: function(){
        //$.ajax({'url':'/templates/users/userRow.tpl','success': function(tpl){ this.template = App.template(tpl);} ,'dataType':"HTML", 'async':false});
        this.template = App.template("<td><%=id%></td>");
    },
    render: function(){

        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});

App.View.UserTable = Backbone.View.extend({
    tagName: 'table',
    template: function(){},
    initialize: function(){

    },
    render: function(){
        this.$el.append();
    }
});