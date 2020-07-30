/*
*Valid function
 */
var validateRootElement = '.validate-root';
var Valid = {};


/*
 * require
 */
Valid.require = function(form) {

    var n=0;
    $(form+' ._required').each( function() {
        if($(this).is(':disabled') == true){return 1}
        console.log(1);
        var value = $(this).val();
        value = $.trim(value);
        var pr = $(this).parents(validateRootElement);
        var msg_error = ( $(this).attr('msg-error')  === undefined ) ? 'Trường này không được để trống' :  $(this).attr('msg-error') ;

        if(value == '' || value === null) {
            pr.find('.mess_text_error').html(msg_error);
            pr.addClass('has-error');
            n++;
        } else {
            pr.removeClass('has-error');
        }
    });

    if(n >0 ) {
        this.focus();
        return 0;
    }

    return 1;
};

/*
 * number
 */
Valid.number = function(form) {
    var n = 0;
    var regex = /^-?(\d+\.?\d*)$|(\d*\.?\d+)$/;

    $(form+' ._number').each( function() {

        if($(this).is(':disabled') == true){
            return 1;
        }

        var value = $(this).val();
        value = $.trim(value);
        var pr = $(this).parents(validateRootElement);
        var msg_error = ( $(this).attr('msg-error')  === undefined ) ? validate_msg.format_number :  $(this).attr('msg-error') ;

        if(value != '') {

            if (isNaN(value) || !regex.test(value) || value <= 0) {
                pr.find('.mess_text_error').html(msg_error);
                pr.addClass('has-error');
                n++;
            } else {
                pr.removeClass('has-error');
            }
        }
    });

    if(n >0 ) {
        $('.has-error input:eq(0), .has-error select:eq(0), .has-error textarea:eq(0)').focus();
        return 0;
    }
    return 1;

};
/*
 *Email
 */
Valid.email = function(form) {
    var n = 0;
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    $(form+' ._email').each( function() {

        if($(this).is(':disabled') == true){
            return 1;
        }

        var value = $(this).val();
        value = $.trim(value);
        var pr = $(this).parents(validateRootElement);
        var msg_error = ( $(this).attr('msg-error')  === undefined ) ? validate_msg.required_general :  $(this).attr('msg-error') ;

        if(value != '') {

            if(!regex.test(value)) {
                pr.find('.mess_text_error').html(msg_error);
                pr.addClass('has-error');
                n++;
            } else {
                pr.removeClass('has-error');
            }
        }
    });

    if(n >0 ) {
        $('.has-error input:eq(0), .has-error select:eq(0), .has-error textarea:eq(0)').focus();
        return 0;
    }

    return 1;

};

/*
 * Zipcode
 * TODO : add code validate zip code
 */
Valid.zipcode = function() {
    return 1;
};

/*
 * date
 * TODO : add code validate date
 */

Valid.date = function() {
    return 1;
};

/*
* validate only one unit
 */

Valid.onlyUnit = function(form) {
    var arr = [];
    var n = 0;

    $(form+' ._only-unit').each( function() {
        var value = $.trim( $(this).val());

        if( jQuery.inArray( value, arr ) !=  -1) {
            n = 1 ;
        }

        arr.push(value);
    });

    return n;

};


Valid.nameOfPerson = function(form) {
    var n = 0;

    var regex = /^[a-zA-Z0-9_ ÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴàáạảãâầấậẩẫăằắặẳẵÈÉẸẺẼÊỀẾỆỂỄèéẹẻẽêềếệểễÌÍỊỈĨìíịỉĩÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠòóọỏõôồốộổỗơờớợởỡÙÚỤỦŨƯỪỨỰỬỮùúụủũưừứựửữỲÝỴỶỸỳýỵỷỹĐđ]+$/;

    $(form+' ._nameOfPerson').each( function() {

        if($(this).is(':disabled') == true){
            return 1;
        }
        var value = $(this).val();
        value = $.trim(value);
        var pr = $(this).parents(validateRootElement);
        var msg_error = ( $(this).attr('msg-error')  === undefined ) ? validate_msg.required_general :  $(this).attr('msg-error') ;

        if(value == '' || value == null) {
            pr.find('.mess_text_error').html(msg_error);
            pr.addClass('has-error');
            n++;
        } else if(!regex.test(value)) {
            msg_error = validate_msg.special_character;
            pr.find('.mess_text_error').html(msg_error);
            pr.addClass('has-error');
            n++;
        } else {
            pr.removeClass('has-error');
        }
    });

    if(n >0 ) {
        $('.has-error input:eq(0), .has-error select:eq(0), .has-error textarea:eq(0)').focus();
        return 0;
    }

    return 1;

};


/*
 * Error focus
 */
Valid.focus = function(){
    $('.has-error input:eq(0), .has-error select:eq(0), .has-error textarea:eq(0)').focus();

}

Valid.valid = function(form){
    form = (form) ? form : 'body';
    var isValid =  this.require(form)*this.number(form)*this.email(form)*this.nameOfPerson(form);

    return (isValid == 0) ? false : true;
}

Valid.isNameValid = function(form){
    form = (form) ? form : 'body';
    var isValid =  this.nameOfPerson(form);
    return (isValid == 0) ? false : true;
}
