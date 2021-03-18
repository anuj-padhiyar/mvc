var Base = function(){};

Base.prototype = {
    method : 'post',
    url : null,
    params : {},

    alert : function(){
        alert(1234);
    },
    setMethod : function(method){
        this.method = method;
        return this;
    },
    getMethod : function(){
        return this.method;
    },
    setUrl : function(url){
        this.url=url;
        return this;
    },
    getUrl : function(){
        return this.url;
    },
    setParams : function(params){
        this.params=params;
        return params;
    },
    getParams : function(){
        return this.params;
    },
    resetParams : function(){
        this.params = {};
        return this;
    },
    addParam : function(key, value){
        this.params[key] = value;
        return this;
    },
    removeParam : function(key){
        if(typeof this.params[key] != undefined){
            delete this.params[key];
        }
        return this;
    },
    load : function(){
        var self = this;
        var request = $.ajax({
            url:this.getUrl(),
            method:this.getMethod(),
            data:this.getParams(),
            success:function(response){
                self.manageHtml(response);
            }
        });
    },
    manageHtml:function(response){
        if(typeof response.element == 'undefined'){
            return false;
        }
        if(typeof response.element == 'object'){
            $(response.element).each(function(i,element){
                $(element.selector).html(element.html);
            })
        }else{
            $(response.element.selector).html(response.element.html);
        }
    },
    setForm:function(){
        var id = '#'+$('form').attr('id');
        this.setParams($(id).serializeArray());
        this.setMethod($(id).attr('method'));
        this.setUrl($(id).attr('action'));
        this.load();
    }
}

var mage = new Base();
mage.setUrl('http://localhost/phpCode/Session3_Php/MVC/index.php?c=category&a=grid');
mage.load();