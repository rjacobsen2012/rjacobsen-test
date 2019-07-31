let modalCount = 0;

let CustomModal = {
    create: function(content, reloadMethod, parameters){
        modalCount = modalCount+1;

        let data_attributes = '';
        let data_attribute_keys = [];

        if (parameters && parameters.data_attributes) {
            for (let i = 0; i < parameters.data_attributes.length; i++) {
                data_attribute_keys.push(parameters.data_attributes[i].key);
                data_attributes = data_attributes + ' ' + parameters.data_attributes[i].key + '="' + parameters.data_attributes[i].value + '"'
            }
            data_attributes = data_attributes + ' data-attribute-keys="' + data_attribute_keys + '"';
        }

        if (reloadMethod) {
            reloadMethod = ' data-reload="'+reloadMethod+'"';
        } else {
            reloadMethod = '';
        }

        let modal = '<div id="gridSystemModal" class="modal fade customModal'+modalCount+'" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true"'+reloadMethod+data_attributes+'>' +
            '<div class="modal-dialog modal-sm" role="document">' +
            '<div class="modal-content custom-content">'+
            content +
            '</div>' +
            '</div>';

        $('body').append(modal);
        return '.customModal'+modalCount;
    },
    open: function(content, reloadMethod, parameters){
        let modalId = this.create(content, reloadMethod, parameters);
        $(modalId).modal({
            keyboard: false
        });
        $('body').removeAttr('style');
    },
    close: function(id){
        $(id).modal('hide');
    }
};

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#logout-btn', function (event) {
        event.preventDefault();
        $('#logout-form').submit();
    });

    $(document).on('click', '.trash', function (event) {
        event.preventDefault();
        $('#' + $(this).attr('data-recipe-id')).submit();
    });

    $(document).on('click', '#choose_rec_file_button', function () {
        $('input#rec_thumbnail').click();
    });

    $(document).on('change', 'input#rec_thumbnail', function () {
        var _input = $(this);

        $('#rec_chosen_file').text(_input.val().split('\\').pop());
    });

    $(document).on('click', '#choose_cat_file_button', function () {
        $('input#cat_thumbnail').click();
    });

    $(document).on('change', 'input#cat_thumbnail', function () {
        var _input = $(this);

        $('#cat_chosen_file').text(_input.val().split('\\').pop());
    });

    $(document).on('click', '.add-category', function () {
        createRecipe();
    });

    $(document).on('hidden.bs.modal', '.modal', function () {
        onHideModal();
    });

    $(document).on('show.bs.modal', '.modal', function () {
        onShowModal();
    });

    $(document).on('focus', '.color-field', function () {
        $(this).closest('div').css('color', '#998EB8');
        $(this).css('border-bottom', '2px solid #998EB8');
    });

    $(document).on('blur', '.color-field', function () {
        $(this).closest('div').css('color', '#C1BDC2');
        $(this).css('border-bottom', '2px solid #C1BDC2');
    });

    $(document).on('keyup', '.color-field', function () {
        checkFields();
    });

    $(document).on('keyup', '#cat_title_field', function () {
        checkCatFields();
    });

    searchCategories('');

    $(document).on('keyup', '#cat_search', function () {
        searchCategories($(this).val());
    });

    $(document).on('click', '.clear-search', function () {
        $('#cat_search').val('');
        searchCategories('');
    });

    $(document).on('click', '.sidebar-toggle', function () {
        $(".categories-sidebar").toggleClass("collapsed");
        $("#content").toggleClass("col-md-12 col-md-9");
    });

    $(document).on('click', '#add_recipe', function () {
        $(this).closest('form').submit();
    });
});

function checkFields() {
    if ($('#title_field').val() && $('#description_field').val() && $('select[name="recipe_category_id"] option:selected').val()) {
        $('#add_recipe').removeAttr('disabled').removeClass('disabled');
    } else {
        $('#add_recipe').attr('disabled', 'disabled').addClass('disabled');
    }
}

function checkCatFields() {
    if ($('#cat_title_field').val()) {
        $('#add_category').removeAttr('disabled').removeClass('disabled');
    } else {
        $('#add_category').attr('disabled', 'disabled').addClass('disabled');
    }
}

function csrfToken() {
    return $('meta[name="csrf-token"]').attr('content');
}

function modalCreate(modal, url, data) {
    Loader.auto();
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        success: function (response) {
            $('.custom-content', $(modal)).html(response);
            Loader.close();
            window.location.href = '/all-recipes';
        },
        error: function () {
            Loader.close();
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function onHideModal()
{
    let hiddenModal = $('.modal:hidden');
    let reloadCommand = $(hiddenModal).attr('data-reload');
    let arg1, arg2, arg3;

    let data_attribute_keys = $(hiddenModal).attr('data-attribute-keys');

    if (data_attribute_keys) {
        let arr = data_attribute_keys.split(',');

        if (arr[0]) {
            arg1 = $(hiddenModal).attr(arr[0]);
        }

        if (arr[1]) {
            arg2 = $(hiddenModal).attr(arr[1]);
        }

        if (arr[2]) {
            arg3 = $(hiddenModal).attr(arr[2]);
        }
    }

    $(hiddenModal).next().remove();
    $(hiddenModal).remove();
    modalCount = modalCount - 1;

    let nextModal = $('.custom-modal-hide');

    if (nextModal.length > 1) {
        nextModal = $(nextModal).last();
    }

    if ($(nextModal).length) {
        $(nextModal).addClass('modal').addClass('in').removeClass('custom-modal-hide');
        $(nextModal).next().addClass('modal-backdrop').addClass('in').removeClass('custom-modal-backdrop-hide');
        let body = $('body');
        if (!body.hasClass('modal-open')) {
            body.addClass('modal-open');
        }
    }

    if (reloadCommand) {
        if (arg1) {
            eval(reloadCommand)($(nextModal), arg1);
        } else if (arg2) {
            eval(reloadCommand)($(nextModal), arg1, arg2);
        } else if (arg3) {
            eval(reloadCommand)($(nextModal), arg1, arg2, arg3);
        } else {
            eval(reloadCommand)($(nextModal));
        }
    }
}

function onShowModal()
{
    let i;
    let modals = $('.modal:visible');
    for (i = 0; i < modals.length; i++) {
        if (i !== modals.length+1) {
            let found = modals[i];
            $(found).addClass('custom-modal-hide').removeClass('modal').removeClass('in');
            $(found).next().addClass('custom-modal-backdrop-hide').removeClass('modal-backdrop').removeClass('in');
        }
    }
}

function openModal(content, reloadMethod, parameters)
{
    CustomModal.open(content, reloadMethod, parameters);
}

function createRecipe() {
    Loader.auto();
    $.ajax({
        url: '/api/v1/recipes/create',
        type: 'GET',
        success: function (response) {
            openModal(response);
            Loader.close();
        },
        error: function () {
            Loader.close();
        }
    });
}

function searchCategories(search_term) {
    const url = search_term !== '' ? '/api/v1/categories/' + search_term : '/api/v1/categories';
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#categories_holder').html(response);
        }
    });
}
