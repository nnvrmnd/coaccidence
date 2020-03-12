let empty = /^\s*$/,
   looking_up,
   ls_selected;

/* Low prio Control.php */
$(function () {
   $('.new')
      .on('hidden.bs.modal', function () {
         $(this)
            .find('form')
            .trigger('reset');
      })
      .on('shown.bs.modal', function () {
         $(this)
            .find('input')
            .first()
            .focus();
      });

   /* Refresh table names */
   $('#refresh_list').click(function (e) {
      e.preventDefault();
      LoadNames(ls_selected);
      if (looking_up != undefined && !looking_up.match(empty)) {
         setTimeout(() => {
            FilterNames(looking_up);
         }, 100);
      }
   });

   /* Click delete name */
   $('#names_list').on('click', '.del_name', function (e) {
      e.preventDefault();

      let btn_id = $(this).attr('data-id');

      PromptModal('Are you deleting this name?', 0, 5000, 'del_name', btn_id);
   });

   /* Click reset all status */
   $('#reset_all').click(function (e) {
      e.preventDefault();

      PromptModal(
         'Are you reseting all the status?',
         0,
         5000,
         'reset_all',
         ls_selected
      );
   });

   /* Click add name */
   $('#add_name').click(function (e) {
      e.preventDefault();
      $('#NewNameModal').modal('show');
   });

   /* Click add list */
   $('#add_list').click(function (e) {
      e.preventDefault();
      $('#NewListModal').modal('show');
   });

   /* Click delete list */
   $('#delete_list').click(function (e) {
      e.preventDefault();
      PromptModal(
         'Are you deleting selected list?',
         0,
         5000,
         'delete_list',
         ls_selected
      );
   });

   /* Click upload csv */
   $('#up_csv').click(function (e) {
      e.preventDefault();
      $('#CSVModal').modal('show');
   });

   /* On open CSV modal */
   $('#CSVModal').on('shown.bs.modal', function () {
      $('#NewNameModal').modal('hide');
   });

   /* Return to add name modal */
   $('#csv_back').click(function (e) {
      e.preventDefault();
      setTimeout(() => {
         $('#NewNameModal').modal('show');
      }, 500);
   });

   /* Click dummy */
   $('#dummy').click(function (e) {
      e.preventDefault();
      $('#csv').click();
   });

   /* Display file name */
   $('#csv').on('change', function () {
      let regex = /[\/\\]([\w\d\s\'\.\,\-\(\)]+)$/,
         dummy = $('#dummy'),
         this_element = $(this).attr('id'),
         fakepath = $(this).val(),
         filename,
         selected = () => {
            if (fakepath.match(regex) != null) {
               filename = fakepath.match(regex)[1];

               if (filename.length >= 12) {
                  // if file name is long
                  return (
                     filename.substr(0, 11) +
                     '...' +
                     filename.substr(filename.length - 11)
                  );
               } else {
                  return filename;
               }
            } else {
               return 'invalid';
            }
         };

      if (fakepath) {
         let slctd = selected();
         switch (slctd) {
            case 'invalid':
               dummy.val('').addClass('is-invalid');
               $(`small.${this_element}`)
                  .addClass('text-warning')
                  .html('Invalid filename. Rename file.');
               $(this).val('');
               break;

            default:
               $('#dummy').val(slctd);
               dummy.removeClass('is-invalid');
               $(`small.${this_element}`).html('');
               break;
         }
      } else {
         // clear dummy if empty
         $('#dummy').val('');
         dummy.removeClass('is-invalid');
         $(`small.${this_element}`).html('');
      }
   });
});

/* High prio Control.php */
$(function () {
   LoadList('list_select');

   /* Confirm prompt */
   $('#yes_prompt').click(function (e) {
      e.preventDefault();

      let act = $(this).attr('data-action'),
         id = $(this).attr('data-target');

      $.post(
         './assets/hndlr/Control.php', {
            act,
            id
         },
         function (res) {
            if (res != 'err:action' && res == 'true') {
               LoadNames(ls_selected);
               if (looking_up != undefined && !looking_up.match(empty)) {
                  setTimeout(() => {
                     FilterNames(looking_up);
                  }, 100);
               }

               switch (act) {
                  case 'del_name':
                     SuccessModal('Name has been removed.', 0, 3000);
                     break;
                  case 'reset_all':
                     SuccessModal('All status has been reset.', 0, 3000);
                     break;
                  case 'delete_list':
                     SuccessModal('List has been deleted.', 0, 3000);
                     break;
               }

               if (act == 'delete_list') {
                  LoadList('list_select');
                  setTimeout(() => {
                     $(`#list_select option[value=""]`)
                        .attr('selected', 'selected')
                        .trigger('change');
                  }, 100);
                  setTimeout(() => {
                     none_selected();
                  }, 500);
               }
            } else {
               ErrorModal(0, 0, 3000);
            }
         }
      );
   });

   /* Selected from list */
   $('select#list_select').change(function (e) {
      e.preventDefault();

      ls_selected = $(this).val();

      if (!ls_selected.match(empty)) {
         LoadNames(ls_selected);
         $('#search_filter')
            .removeAttr('disabled')
            .val('');
         $('.ctrl_buttons').removeClass('d-none');
         $('.list_btn').removeClass('d-none');
      } else {
         none_selected();
         $('#search_filter')
            .attr('disabled', 'true')
            .val('');
         $('.ctrl_buttons').addClass('d-none');
         $('.list_btn').addClass('d-none');
      }
   });

   /* Search filter */
   $('#search_filter').keyup(function (e) {
      e.preventDefault();

      looking_up = $(this)
         .val()
         .toLowerCase();

      FilterNames(looking_up);
   });

   /* Toggle status */
   $('#names_list').on('click', '.toggle_stat', function (e) {
      e.preventDefault();

      let btn_id = $(this).attr('data-id');

      $.post(
         './assets/hndlr/Control.php', {
            toggle: btn_id
         },
         function (res) {
            if (res != 'err:toggle') {
               LoadNames(ls_selected);
               if (looking_up != undefined && !looking_up.match(empty)) {
                  setTimeout(() => {
                     FilterNames(looking_up);
                  }, 100);
               }
            } else {
               console.log(res);
               alert('SOMETHING WENT WRONG!');
            }
         }
      );
   });

   /* Add new name */
   $('#newname_form').submit(function (e) {
      e.preventDefault();

      let form = $(this).serializeArray();
      form.push({
         name: 'to_list',
         value: ls_selected
      });

      $.post('./assets/hndlr/Control.php', form, function (res) {
         if (res != 'err:insert') {
            LoadNames(ls_selected);
            if (looking_up != undefined && !looking_up.match(empty)) {
               setTimeout(() => {
                  FilterNames(looking_up);
               }, 100);
            }
            SuccessModal('New name added.', 0, 3000);
         } else {
            console.log(res);
            alert('SOMETHING WENT WRONG!');
         }
      });
   });

   /* Add list */
   $('#newlist_form').submit(function (e) {
      e.preventDefault();

      let form = $(this).serialize();

      switch (false) {
         case ValidateRequired('newlist_form', 'title'):
            break;

         default:
            $.post('./assets/hndlr/Control.php', form, function (res) {
               if (res != 'err:list') {
                  LoadList('list_select');
                  setTimeout(() => {
                     $(`#list_select option[value="${res}"]`)
                        .attr('selected', 'selected')
                        .trigger('change');
                     $('#NewListModal').modal('hide');
                  }, 100);
                  setTimeout(() => {
                     LoadNames(ls_selected);
                     $('#NewNameModal').modal('show');
                  }, 500);
               }
            });
            break;
      }
   });

   /* Upload CSV */
   $('#csv_form').submit(function (e) {
      e.preventDefault();

      let form = $(this).serializeArray(),
         form_data = new FormData(),
         file = $('#csv')[0].files[0];

      form.push({
         name: 'to_list',
         value: ls_selected
      });

      switch (false) {
         case ValidateAttachment('csv_form', 'csv', 'dummy'):
            break;

         default:
            form_data.append('csv', file);
            $.each(form, function (key, input) {
               form_data.append(input.name, input.value);
            });

            $.ajax({
               type: 'POST',
               url: './assets/hndlr/Control.php',
               data: form_data,
               contentType: false,
               processData: false,
               success: function (res) {
                  if (res == 'true') {
                     LoadNames(ls_selected);
                     if (looking_up != undefined && !looking_up.match(empty)) {
                        setTimeout(() => {
                           FilterNames(looking_up);
                        }, 100);
                     }
                     SuccessModal('Name has been removed.', 0, 3000);
                  } else {
                     console.log(res);
                     ErrorModal(0, 0, 3000);
                  }
               }
            });
            break;
      }
   });
});

var timer = null; // for timeouts

/* Load lists on select option */
function LoadList(selector) {
   $.post(
      './assets/hndlr/Control.php', {
         fetchlist: 'all'
      },
      function (res) {
         $(`select#${selector}`).html(
            `<option class="text-muted" value="" selected>Select list...</option>`
         );
         if (res != 'err:fetchlist') {
            $.each(JSON.parse(res), function (idx, el) {
               $(`select#${selector}`).append(`
                  <option class="text-dark font-weight-bold" value="${el.list_id}">${el.title}</option>
               `);
            });
         }
      }
   );
}

/* Load names on table */
function LoadNames(selected) {
   $.post(
      './assets/hndlr/Control.php', {
         fetchnames: selected
      },
      function (res) {
         $('tbody#names_list').html('');
         if (res != 'err:fetchnames') {
            $.each(JSON.parse(res), function (idx, el) {
               $('tbody#names_list').append(`
               <tr>
                  <td>${el.given} ${el.surname}</td>
                  <td>${el.status}</td>
                  <td class="text-right">
                     <button type="button" class="btn btn-info btn-link btn-icon btn-sm btn-simple toggle_stat" data-toggle="tooltip" data-placement="bottom" title="Toggle status" data-container="body" data-id="${el.name_id}">
                        <i class="tim-icons icon-refresh-01"></i>
                     </button>
                     <button type="button" class="btn btn-danger btn-link btn-icon btn-sm btn-simple del_name" data-toggle="tooltip" data-placement="bottom" title="Remove name" data-container="body" data-id="${el.name_id}">
                        <i class="tim-icons icon-simple-delete"></i>
                     </button>
                  </td>
               </tr>
               `);
            });
         } else if (res == 'err:fetchnames') {
            $('tbody#names_list').html(`<tr>
            <td></td>
            <td><i>This list is empty...</i></td>
            <td class="text-right"></td>
            </tr>`);
         }
      }
   );
}

/* Search table */
function FilterNames(search) {
   $('#names_list tr').filter(function () {
      $(this).toggle(
         $(this)
         .text()
         .toLowerCase()
         .indexOf(search) > -1
      );
   });
}

function none_selected() {
   let none_selected = `<tr>
      <td></td>
      <td><i>Please select a list above...</i></td>
      <td class="text-right"></td>
      </tr>`;

   $('tbody#names_list').html(none_selected);
}

function PromptModal(msg, redirect, timeout, action, id) {
   $('#yes_prompt')
      .attr('data-action', action)
      .attr('data-target', id);

   if (redirect !== 0) {
      $('#PromptModal').on('hidden.bs.modal', function () {
         window.location.href = redirect;
      });
   }

   window.clearTimeout(timer);
   $('#prompt-modal-msg').html(msg);
   /* $('.modal').modal('hide'); */
   $('#PromptModal').modal('show');

   timer = setTimeout(() => {
      $('#prompt-modal-msg').html('');
      $('#PromptModal').modal('hide');
      timer = null;
   }, timeout);
}

function ValidateAttachment(form_id, name, dummy_name) {
   let ctrl = true,
      formid = `form#${form_id} `,
      name_attr = formid + `[name="${name}"]`,
      dummy = formid + `[name="${dummy_name}"]`,
      file_format;

   if ($(name_attr).val().length >= 1) {
      file_format = $(name_attr)[0].files[0].type;

      if (!file_format.match(/\b(\w*vnd.ms-excel\w*)\b/gi)) {
         ctrl = false;
         $(dummy).addClass('is-invalid');
         $('small.' + name)
            .removeClass('text-success')
            .addClass('text-warning')
            .html('File not CSV.');
      }
   } else {
      ctrl = false;
      $(dummy).addClass('is-invalid');
      $('small.' + name)
         .removeClass('text-success')
         .addClass('text-warning')
         .html('Select a file.');
   }

   return ctrl;
}

/* Validate required input */
function ValidateRequired(form_id, name) {
   let ctrl = true,
      formid = `form#${form_id} `,
      name_attr = formid + `[name="${name}"]`,
      input = $(name_attr).val(),
      regex = /^\s*$/,
      required = !input.match(regex) ? true : false;

   switch (false) {
      case required:
         $(name_attr).addClass('is-invalid');
         $(formid + 'small.' + name)
            .removeClass('text-success')
            .addClass('text-warning')
            .html('Field required.');
         ctrl = false;
         break;

      default:
         unicode(name);
         $(name_attr).removeClass('is-invalid');
         $(formid + 'small.' + name)
            .removeClass('text-success')
            .html('');
         break;
   }

   return ctrl;
}

function unicode(name) {
   let this_name = $(`[name="${name}"]`).val();

   this_name
      .replace(/\!/g, '&#33;')
      .replace(/"/g, '&#34;')
      .replace(/\#/g, '&#35;')
      .replace(/\$/g, '&#36;')
      .replace(/\%/g, '&#37;')
      .replace(/&/g, '&#38;')
      .replace(/'/g, '&#39;')
      .replace(/\(/g, '&#40;')
      .replace(/\)/g, '&#41;')
      .replace(/\*/g, '&#42;')
      .replace(/\+/g, '&#43;')
      .replace(/,/g, '&#44;')
      .replace(/-/g, '&#45;')
      .replace(/./g, '&#46;')
      .replace(/\//g, '&#47;')
      .replace(/:/g, '&#58;')
      .replace(/;/g, '&#59;')
      .replace(/\</g, '&#60;')
      .replace(/\=/g, '&#61;')
      .replace(/\>/g, '&#62;')
      .replace(/\?/g, '&#63;')
      .replace(/\@/g, '&#64;')
      .replace(/\[/g, '&#91;')
      .replace(/\\/g, '&#92;')
      .replace(/\]/g, '&#93;')
      .replace(/\^/g, '&#94;')
      .replace(/_/g, '&#95;')
      .replace(/`/g, '&#96;')
      .replace(/\{/g, '&#123;')
      .replace(/|/g, '&#124;')
      .replace(/\}/g, '&#125;')
      .replace(/~/g, '&#126;');
}

function SuccessModal(msg, redirect, timeout) {
   if (redirect !== 0) {
      $('#SuccessModal').on('hidden.bs.modal', function () {
         window.location.href = redirect;
      });
   }

   window.clearTimeout(timer);
   $('.modal').modal('hide');
   $('#success-modal-msg').html(msg);
   $('#SuccessModal').modal('show');

   timer = setTimeout(() => {
      $('#success-modal-msg').html('');
      $('#SuccessModal').modal('hide');
      timer = null;
   }, timeout - 1000);
}

function ErrorModal(msg, redirect, timeout) {
   let message = msg === 0 ? 'Something went wrong.' : msg;

   if (redirect !== 0) {
      $('#SuccessModal').on('hidden.bs.modal', function () {
         window.location.href = redirect;
      });
   }

   window.clearTimeout(timer);
   $('#error-modal-msg').html(message);
   $('.modal').modal('hide');
   $('#ErrorModal').modal('show');

   timer = setTimeout(() => {
      $('#error-modal-msg').html('');
      $('#ErrorModal').modal('hide');
      timer = null;
   }, timeout - 1000);
}

let player_qty,
   spinlist_selected = '';

$(function () {
   LoadList('spinlist_select');

   /* Spin the roulette */
   $('#spin_btn').click(function (e) {
      e.preventDefault();

      let rows = $('#player_list').find('tr'),
         regex = /[0-9]/g,
         player_qty = $('#spinlist_qty').val(),
         qty = !player_qty.match(regex) == true ? '1' : player_qty,
         duplicate_entry = false;

      if (spinlist_selected == '') {
         ErrorModal('Please select a list above.', 0, 5000);
      } else {
         window.clearTimeout(timer);
         $('.modal').modal('hide');
         $('#SpinModal').modal('show');

         $.post(
            './assets/hndlr/Spin.php', {
               qty,
               spinlist_selected
            },
            function (res) {
               if (res != 'err:spin') {
                  $.each(JSON.parse(res), function (idx, el) {
                     setTimeout(() => {
                        $('tbody#player_list').append(`
                        <tr id="${el.name_id}">
                           <td>${el.given} ${el.surname}</td>
                           <td class="status-${el.name_id}"><span class="font-italic">playing...</span></td>
                           <td class="text-right actions-${el.name_id}">
                              <button type="button" class="btn btn-success btn-link btn-icon btn-sm btn-simple this_winner" data-toggle="tooltip" data-placement="bottom" title="Set winner" data-container="body" data-id="${el.name_id}">
                                 <i class="tim-icons icon-check-2"></i>
                              </button>
                              <button type="button" class="btn btn-warning btn-link btn-icon btn-sm btn-simple rm_player" data-toggle="tooltip" data-placement="bottom" title="Remove player" data-container="body" data-id="${el.name_id}">
                                 <i class="tim-icons icon-simple-delete"></i>
                              </button>
                           </td>
                        </tr>
                        `);

                        if (rows != null) {
                           rows.each(function (indx, elmnt) {
                              if (this.id == el.name_id) {
                                 duplicate_entry = true;
                                 $('tbody#player_list')
                                    .find(`tr[id="${el.name_id}"]`)
                                    .remove();
                              }
                           });
                        }
                     }, 1500);
                  });
               } else if (res == 'err:fetchnames') {
                  setTimeout(() => {
                     $('tbody#player_list').html(`<tr>
                  <td></td>
                  <td><i>No listed names...</i></td>
                  <td class="text-right"></td>
                  </tr>`);
                  }, 1500);
               }
            }
         );
      }

      timer = setTimeout(() => {
         $('#SpinModal').modal('hide');
         if (duplicate_entry == true) {
            ErrorModal('Duplicate entry, please spin again.', 0, 5000);
         }
         timer = null;
      }, 5000);
   });

   $('#player_list').on('click', '.rm_player', function () {
      let id = $(this).attr('data-id');
      $('#player_list')
         .find(`tr[id="${id}"]`)
         .remove();
   });

   $('#player_list').on('click', '.this_winner', function () {
      let id = $(this).attr('data-id'),
         player_list = $('#player_list'),
         test = '';

      player_list.find(`.actions-${id}`).html('');

      $.post(
         './assets/hndlr/Spin.php', {
            winner: id
         },
         function (res) {
            if (res == 'true') {
               player_list
                  .find(`.status-${id}`)
                  .addClass('font-weight-bold')
                  .html('WINNER');
               setTimeout(() => {
                  player_list.find(`tr[id="${id}"]`).fadeOut('slow');
                  setTimeout(() => {
                     player_list.find(`tr[id="${id}"]`).remove();
                  }, 1000);
               }, 5000);
            } else {
               console.log('Something went wrong');
            }
         }
      );
   });

   $('#clear_list').click(function (e) {
      e.preventDefault();
      $('tbody#player_list').html('');
   });

   $('#spinlist_select').change(function (e) {
      e.preventDefault();

      let selected = $(this).val();

      if (selected == '') {
         $('#spinlist_qty').val('');
         $('tbody#player_list').html('');
         $('#clear_list').addClass('d-none');
      } else if (selected != '') {
         spinlist_selected = selected;
         $('#clear_list').removeClass('d-none');
      }
   });
});