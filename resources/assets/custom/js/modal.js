// let modalCount = 0;
//
// let CustomModal = {
//     create: function(content, reloadMethod, parameters){
//         modalCount = modalCount+1;
//
//         let data_attributes = '';
//         let data_attribute_keys = [];
//
//         if (parameters && parameters.data_attributes) {
//             for (let i = 0; i < parameters.data_attributes.length; i++) {
//                 data_attribute_keys.push(parameters.data_attributes[i].key);
//                 data_attributes = data_attributes + ' ' + parameters.data_attributes[i].key + '="' + parameters.data_attributes[i].value + '"'
//             }
//             data_attributes = data_attributes + ' data-attribute-keys="' + data_attribute_keys + '"';
//         }
//
//         if (reloadMethod) {
//             reloadMethod = ' data-reload="'+reloadMethod+'"';
//         } else {
//             reloadMethod = '';
//         }
//
//         let modal = '<div id="gridSystemModal" class="modal fade customModal'+modalCount+'" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true"'+reloadMethod+data_attributes+'>' +
//             '<div class="modal-dialog modal-lg" role="document">' +
//             '<div class="modal-content custom-content">'+
//             content +
//             '</div>' +
//             '</div>';
//
//         $('body').append(modal);
//         return '.customModal'+modalCount;
//     },
//     open: function(content, reloadMethod, parameters){
//         let modalId = this.create(content, reloadMethod, parameters);
//         $(modalId).modal({
//             keyboard: false
//         });
//         $('body').removeAttr('style');
//     },
//     close: function(id){
//         $(id).modal('hide');
//     }
// };
//
// $(document).ready(function(){
//     $(document).on('hidden.bs.modal', '.modal', function () {
//         onHideModal();
//     });
//
//     $(document).on('show.bs.modal', '.modal', function () {
//         onShowModal();
//     });
// });
//
// function openModal(content, reloadMethod, parameters)
// {
//     CustomModal.open(content, reloadMethod, parameters);
// }
//
// function onHideModal()
// {
//     let hiddenModal = $('.modal:hidden');
//     let reloadCommand = $(hiddenModal).attr('data-reload');
//     let arg1, arg2, arg3;
//
//     let data_attribute_keys = $(hiddenModal).attr('data-attribute-keys');
//
//     if (data_attribute_keys) {
//         let arr = data_attribute_keys.split(',');
//
//         if (arr[0]) {
//             arg1 = $(hiddenModal).attr(arr[0]);
//         }
//
//         if (arr[1]) {
//             arg2 = $(hiddenModal).attr(arr[1]);
//         }
//
//         if (arr[2]) {
//             arg3 = $(hiddenModal).attr(arr[2]);
//         }
//     }
//
//     $(hiddenModal).next().remove();
//     $(hiddenModal).remove();
//     modalCount = modalCount - 1;
//
//     let nextModal = $('.custom-modal-hide');
//
//     if (nextModal.length > 1) {
//         nextModal = $(nextModal).last();
//     }
//
//     if ($(nextModal).length) {
//         $(nextModal).addClass('modal').addClass('in').removeClass('custom-modal-hide');
//         $(nextModal).next().addClass('modal-backdrop').addClass('in').removeClass('custom-modal-backdrop-hide');
//         let body = $('body');
//         if (!body.hasClass('modal-open')) {
//             body.addClass('modal-open');
//         }
//     }
//
//     if (reloadCommand) {
//         if (arg1) {
//             eval(reloadCommand)($(nextModal), arg1);
//         } else if (arg2) {
//             eval(reloadCommand)($(nextModal), arg1, arg2);
//         } else if (arg3) {
//             eval(reloadCommand)($(nextModal), arg1, arg2, arg3);
//         } else {
//             eval(reloadCommand)($(nextModal));
//         }
//     }
// }
//
// function onShowModal()
// {
//     let i;
//     let modals = $('.modal:visible');
//     for (i = 0; i < modals.length; i++) {
//         if (i !== modals.length+1) {
//             let found = modals[i];
//             $(found).addClass('custom-modal-hide').removeClass('modal').removeClass('in');
//             $(found).next().addClass('custom-modal-backdrop-hide').removeClass('modal-backdrop').removeClass('in');
//         }
//     }
// }
//
// function modalDeleteClick(parameters) {
//     parameters.form = $('form[name="delete"]', parameters.element.closest('.form-holder'));
//     parameters.type = 'modalDelete';
//     modalModify(parameters);
// }
//
// function modalCreateClick(parameters) {
//     parameters.form = $('form[name="create"]', parameters.element.closest('.form-holder'));
//     parameters.type = 'modalCreate';
//     modalModify(parameters);
// }
//
// function modalUpdateClick(parameters) {
//     parameters.form = $('form[name="update"]', parameters.element.closest('.form-holder'));
//     parameters.type = 'modalUpdate';
//     modalModify(parameters);
// }
//
// function modalSelectChange(parameters) {
//     parameters.form = $('form[name="'+parameters.element.attr('data-form')+'"]', parameters.element.closest('.form-holder'));
//     $('input[name="' + parameters.replace + '"]', parameters.form).each(function() {
//         $(this).val($('option:selected', parameters.element).val());
//     });
//     modalOnEnter(parameters);
// }
//
// function modalFieldChange(parameters) {
//     parameters.form = $('form[name="'+parameters.element.attr('data-form')+'"]', parameters.element.closest('.form-holder'));
//     $('input[name="' + parameters.replace + '"]', parameters.form).each(function() {
//         $(this).val(parameters.element.val());
//     });
//     modalOnEnter(parameters);
// }
//
// function modalBootstrapSwitchChangeOn(parameters) {
//     parameters.form = $('form[name="'+parameters.element.attr('data-form')+'"]', parameters.element.closest('.form-holder'));
//     $('input[name="' + parameters.replace + '"]', parameters.form).each(function() {
//         $(this).val('1');
//     });
//     modalOnEnter(parameters);
// }
//
// function modalBootstrapSwitchChangeOff(parameters) {
//     parameters.form = $('form[name="'+parameters.element.attr('data-form')+'"]', parameters.element.closest('.form-holder'));
//     $('input[name="' + parameters.replace + '"]', parameters.form).each(function() {
//         $(this).val('');
//     });
//     modalOnEnter(parameters);
// }
//
// function modalTypeaheadNameChange(parameters) {
//     parameters.form = $('form[name="'+parameters.element.attr('data-form')+'"]', parameters.element.closest('.form-holder'));
//     $('input[name="' + parameters.replace + '"]', parameters.form).each(function() {
//         $(this).val(parameters.datum.name);
//     });
//     modalOnEnter(parameters);
// }
//
// function modalOnEnter(parameters) {
//     if (parameters.event.keyCode === 13) {
//         if (parameters.element.closest('.form-holder').hasClass('edit')) {
//             parameters.type = 'modalUpdate';
//         } else if (parameters.element.closest('.form-holder').hasClass('create')) {
//             parameters.type = 'modalCreate';
//         }
//         modalModify(parameters);
//     }
// }
//
// function modalModify(parameters) {
//     eval(parameters.type)(parameters.element.closest('div.modal'), parameters.form.attr('action'), parameters.form.serialize());
// }
//
// function modalUpdate(modal, url, data) {
//     Loader.auto();
//     $.ajax({
//         url: url,
//         data: data,
//         type: 'PUT',
//         success: function (response) {
//             $('.custom-content', $(modal)).html(response);
//             reloadModalMethods();
//             Loader.close();
//         },
//         error: function () {
//             Loader.close();
//         }
//     });
// }
//
// function modalCreate(modal, url, data) {
//     Loader.auto();
//     $.ajax({
//         url: url,
//         data: data,
//         type: 'POST',
//         success: function (response) {
//             $('.custom-content', $(modal)).html(response);
//             reloadModalMethods();
//             Loader.close();
//         },
//         error: function () {
//             Loader.close();
//         }
//     });
// }
//
// function modalDelete(modal, url, data) {
//     Loader.auto();
//     $.ajax({
//         url: url,
//         data: data,
//         type: 'DELETE',
//         success: function (response) {
//             $('.custom-content', $(modal)).html(response);
//             reloadModalMethods();
//             Loader.close();
//         },
//         error: function () {
//             Loader.close();
//         }
//     });
// }
//
// function modalGet(url, reloadMethod, parameters)
// {
//     Loader.auto();
//
//     $.ajax({
//         url: url,
//         type: 'GET',
//         success: function (response) {
//             openModal(response, reloadMethod, parameters);
//             reloadModalMethods();
//             Loader.close();
//         },
//         error: function () {
//             Loader.close();
//         }
//     });
// }
//
// function modalFormPostReloadContent(form, modal) {
//     Loader.auto();
//     $.ajax({
//         url: form.attr('action'),
//         data: form.serialize(),
//         type: 'POST',
//         success: function (response) {
//             $('.custom-content', modal).html(response);
//             reloadModalMethods();
//             Loader.close();
//         },
//         error: function () {
//             Loader.close();
//         }
//     });
// }
//
// function modalFormPutReloadContent(form, modal) {
//     Loader.auto();
//     $.ajax({
//         url: form.attr('action'),
//         data: form.serialize(),
//         type: 'PUT',
//         success: function (response) {
//             $('.custom-content', modal).html(response);
//             reloadModalMethods();
//             Loader.close();
//         },
//         error: function () {
//             Loader.close();
//         }
//     });
// }
//
// function modalFormDeleteReloadContent(form, modal) {
//     Loader.auto();
//     $.ajax({
//         url: form.attr('action'),
//         data: form.serialize(),
//         type: 'DELETE',
//         success: function (response) {
//             $('.custom-content', modal).html(response);
//             reloadModalMethods();
//             Loader.close();
//         },
//         error: function () {
//             Loader.close();
//         }
//     });
// }
//
// function modalFormUrlPutReloadContent(url, modal) {
//     Loader.auto();
//     $.ajax({
//         url: url,
//         data: {},
//         type: 'PUT',
//         success: function (response) {
//             $('.custom-content', modal).html(response);
//             reloadModalMethods();
//             Loader.close();
//         },
//         error: function () {
//             Loader.close();
//         }
//     });
// }
//
// function modalReloadContent(url, modal)
// {
//     Loader.auto();
//     $.ajax({
//         url: url,
//         type: 'GET',
//         success: function (response) {
//             $('.custom-content', modal).html(response);
//             reloadModalMethods();
//             Loader.close();
//         },
//         error: function () {
//             Loader.close();
//         }
//     });
// }
//
// function reloadModalMethods() {
//     refreshBootstrapSwitch();
//     reloadDatePicker();
//     reloadTypeaheads();
//     datatablesLoad();
// }
