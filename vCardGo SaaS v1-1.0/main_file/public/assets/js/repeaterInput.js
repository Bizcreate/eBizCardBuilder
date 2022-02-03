function checkcount(type) {
    if (type == "hide") {
        var count = document.querySelectorAll('.inputFormRow').length;
        if (count == 3) {
            $('.hideelement').hide();
        }
    } else {
        var count = document.querySelectorAll('.inputFormRow').length;
        if (count <= 3) {
            $('.hideelement').show();
        }
    }
}
var image_count = 0;
var testimonial_image_count = 0;
var testimonial_rating_count = 0;
var radio_count = 1;

function repeaterInput(element, element_type, rowno, divid, path, theme_type, color, assets) {
    // alert(color);
    var html = '';
    var preview_html = '';
    var social_preview_html = '';

    if (element_type == "contact") {
        html = `<tr id="inputFormRow" class="inputFormRow">
                <td>
                  <div class="form-icon-user">
                      <span class="currency-icon"><img class="mb-3 mt-2" src="${assets}/${element.toLowerCase()}.svg" style="color:#082e7b;"></span>
                      <input type="text" id="${element}_${rowno}" name="contact[${rowno}][${element}]" class="keyupinpu form-control mb-0" required/>
                      <input type="hidden" name="contact[${rowno}][id]" value=${rowno}>
                  </div>
                </td>
                <td class="text-right">
                    <a class="delete-icon contact_${rowno}" id="removeRow_contact" data-id="contact_${rowno}"><i class="fas fa-trash"></i></a>
                </td>
              </tr>`;
        if (theme_type == 'theme1' || theme_type == 'theme8') {
            preview_html = `<li class="d-flex align-items-center justify-content-center"  id="contact_${rowno}">
                        <div class="image-icon">
                            <img src="${path}/${color}/${element.toLowerCase()}.svg"  class="img-fluid">
                        </div>
                        <div class="contact-text">
                            <h4 id="${element}_${rowno}_preview"></h4>
                        </div>
                    </li>`;
        }
        i
        if (theme_type == 'theme2') {
            preview_html = `<li class="d-flex align-items-center justify-content-start"  id="contact_${rowno}">
                        <div class="image-icon">
                            <img src="${path}/${color}/contact/${element.toLowerCase()}.svg"  class="img-fluid">
                        </div>
                        <div class="contact-text">
                            <h4 id="${element}_${rowno}_preview"></h4>
                        </div>
                    </li>`;
        }
        if (theme_type == 'theme3') {
            preview_html = `<li class="d-flex align-items-center justify-content-start"  id="contact_${rowno}">
                        <div class="image-icon">
                            <img src="${path}/contact/${element.toLowerCase()}.svg"  class="img-fluid">
                        </div>
                        <div class="contact-text">
                            <h4 id="${element}_${rowno}_preview"></h4>
                        </div>
                    </li>`;
        }
        
        if (theme_type == 'theme4') {

            preview_html = `<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center" id="contact_${rowno}">
                    <div class="image-icon">
                        <img src="${path}/${color}/contact/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                    </div>
                    <div class="contact-text">
                        <a href="">
                            <h4 id="${element}_${rowno}_preview"></h4>
                        </a>
                    </div>
                </li>`;
        }
        if (theme_type == 'theme5') {
            
            preview_html = `<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="contact_${rowno}">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="image-icon">
                        <img src="${path}/${color}/contact/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                    </div>
                    <div class="contact-text">
                        <a href="mialto:contact@alpesh.com">
                            <h4 id="${element}_${rowno}_preview"></h4>
                        </a>

                    </div>
                </div>
            </li>`;
        }
        if (theme_type == 'theme6') {
            
            preview_html = `<li class="d-flex align-items-center justify-content-start" id="contact_${rowno}">
                    <div class="contact-text">
                        <span>${element}</span>

                        <a href="#">
                            <h4 id="${element}_${rowno}_preview"></h4>
                        </a>
                    </div>
                </li>`;
        }
        if (theme_type == 'theme7') {
            preview_html = `<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="contact_${rowno}">
                <div class="image-icon">
                    <img src="${path}/${color}/contact/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                </div>
                <div class="contact-text">
                    <a href="#">
                        <h4 id="${element}_${rowno}_preview"></h4>
                    </a>
                </div>
            </li>`;
        }
        if (theme_type == 'theme8') {

            preview_html = `<li class=""  id="contact_${rowno}">
                        <a href="ssss">
                            <img src="${path}/${color}/contact/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                            <span>${element}</span>
                        </a>
                    </li>`;
        }
        if (theme_type == 'theme9') {
            
            preview_html = `<li  id="contact_${rowno}">
            <div class="d-flex align-items-center justify-content-start">
                <div class="contact-text">
                    <span>
                    ${element}
                    </span>
                    <a href="#">
                        <h4 id="${element}_${rowno}_preview"></h4>
                    </a>
                </div>
            </div>
        </li>`;
        }
        if (theme_type == 'theme10') {
            preview_html = `<li class="" id="contact_${rowno}">
                <a href="#">
                    <div class="image-icon">
                        <img src="${path}/${color}/contact/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                    </div>
                    <div class="contact-text">
                        <p>${element}</p>
                    </div>
                </a>
            </li>`;


        }

        rowno++;
        $("#fieldModal").modal('hide');
    }

    if (element_type == "appointment") {

        html = `<tr id="inputFormRow1">
                <td>
                    <input type="time"  class="form-control timepicker" name="hours[${rowno}][start]" id="appoinment_start_${rowno}" value="" onchange="changeTime(this.id)">
                </td>
                <td>
                  <input type="time" class="form-control timepicker" name="hours[${rowno}][end]" id="appoinment_end_${rowno}" value="" onchange="changeTime(this.id)">
                </td>
                <td class="text-right">
                    <a class="delete-icon appointment_${rowno}" id="removeRow_appointment" data-id="appointment_${rowno}"><i class="fas fa-trash"></i></a>
                </td>
            </tr>`;
        preview_html = `<div class="radio pr-8"  id="appointment_${rowno}">
                        <input id="radio-preview-${radio_count}" name="radio" type="radio">
                        <label for="radio-preview-${radio_count}" class="radio-label"><span id="appoinment_start_${rowno}_preview">00:00</span> - <span id="appoinment_end_${rowno}_preview">00:00</span></label>
                    </div>`;
        if (theme_type == 'theme4' || theme_type == 'theme5' || theme_type == 'theme7' || theme_type == 'theme8' || theme_type == 'theme9') {
            preview_html = `  <li id="appointment_${rowno}"><span id="appoinment_start_${rowno}_preview">00:00</span> - <span id="appoinment_end_${rowno}_preview">00:00</span></li>`;
        }
        radio_count++;
        rowno++;
    }

    if (element_type == "service") {

        html = `<div class="col-6" id="inputFormRow2">
              <div class="card shadow-lg  min-317">
                  <div class="card-body text-center">
                    <div class="float-right">
                      <a class="delete-icon" id="removeRow_services" data-id="services_${rowno}" data-id="services" id="removeRow"><i class="fas fa-trash"></i></a>
                    </div>
                    <div class="avatar-parent-child">
                      <img alt="Image placeholder" src="${path}/logo-placeholder-image-2.png" id="service_image${image_count}" class="avatar imagepreview  rounded-circle avatar-card-lg ml-4">
                      <span class="avatar-child1 avatar-child avatar-card-badge rounded-2 edit-icon " >
                        <i class="fas fa-pen" onclick="selectFile('service_image${image_count}')"></i>
                        <input type="file" id="file-1"  class="custom-input-file custom-input-file-link service_image${image_count}  data-multiple-caption="{count} files selected" multiple="" name="services[${rowno}][image]" >

                      </span>
                    </div>
                    <h4 class="mt-4 font-weight-bold mb-0">
                      <input type="text" id="title_${rowno}"  name="services[${rowno}][title]" class="h4 border-0 text-dark text-center" placeholder="Enter title">

                    </h4>
                      <div class="mt-4 text-dark">
                        <textarea class="border-0 text-dark text-center" id="description_${rowno}" name="services[${rowno}][description]"   placeholder="Enter Description"></textarea>
                      </div>
                  </div>
                </div>

              </div> `;
        var sclass = '';
        preview_html = `<div class="col-lg-6" id="services_${rowno}">`;
        var desc = `<p id="description_${rowno}_preview"></p>`
        if (theme_type == 'theme4' || theme_type == 'theme5' || theme_type == 'theme9' || theme_type == 'theme10') {
            preview_html = `<div class="col-lg-4" id="services_${rowno}">`;
            desc = '';
        } else if (theme_type == 'theme6' || theme_type == 'theme7') {
            preview_html = `<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="services_${rowno}">`;
        }

        if (theme_type == 'theme7') {
            sclass = ' card-contact-shadow mt-2';
        }

        preview_html += `<div class="service-card ${sclass}">
                            <div class="service-card-img">
                                <img id="service_image${image_count}_preview"  src="${path}/image.svg" alt="image" class="img-fluid">
                            </div>
                            <div class="service-card-heading">
                                <h3 id="title_${rowno}_preview">
                                </h3>
                                ${desc}
                                </p>
                            </div>
                        </div>
                    </div>`;
        image_count++;
        rowno++;
    }

    if (element_type == "testimonial") {

        html = `<div class="col-6" id="inputFormRow3">
                <div class="card shadow-lg  min-317">
                    <div class="card-body text-center">
                      <div class="float-right">
                        <a class="delete-icon"  id="removeRow_testimonials" data-id="testimonials_${rowno}"><i class="fas fa-trash"></i></a>
                      </div>
                      <div class="avatar-parent-child">
                        <img alt="Image placeholder" src="${path}" id="testimonial_image${testimonial_image_count}" class="avatar imagepreview  rounded-circle avatar-card-lg ml-4">
                        <span class="avatar-child1 avatar-child avatar-card-badge rounded-2 edit-icon " >
                          <i class="fas fa-pen" onclick="selectFile('testimonial_image${testimonial_image_count}')"></i>
                          <input type="file" id="file-1"  class="custom-input-file custom-input-file-link testimonial_image${testimonial_image_count}"  data-multiple-caption="{count} files selected" multiple="" name="testimonials[${rowno}][image]" >

                        </span>
                      </div>
                      <h4 class="mt-4 font-weight-bold mb-0">
                        <span class="stars${rowno}">0</span>/5

                      </h4>
                      <div class="text-center mt-2">
                      <fieldset id='demo1' class="rating">
                            <input class="stars${rowno}" type="radio" id="testimonials-5-${testimonial_rating_count}" name="testimonials[${rowno}][rating]"  value="5" onclick="getRadio(this)"/>
                            <label class="full" for="testimonials-5-${testimonial_rating_count}" title="Awesome - 5 stars"></label>
                            <input class="stars${rowno}" type="radio" id="testimonials-4-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="4" onclick="getRadio(this)"/>
                            <label class="full" for="testimonials-4-${testimonial_rating_count}" title="Pretty good - 4 stars"></label>
                            <input class="stars${rowno}" type="radio" id="testimonials-3-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="3" onclick="getRadio(this)"/>
                            <label class="full" for="testimonials-3-${testimonial_rating_count}" title="Meh - 3 stars"></label>
                            <input class="stars${rowno}" type="radio" id="testimonials-2-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="2" onclick="getRadio(this)"/>
                            <label class="full" for="testimonials-2-${testimonial_rating_count}" title="Kinda bad - 2 stars"></label>
                            <input class="stars${rowno}" type="radio" id="testimonials-1-${testimonial_rating_count}" name="testimonials[${rowno}][rating]" value="1" onclick="getRadio(this)"/>
                            <label class="full" for="testimonials-1-${testimonial_rating_count}" title="Sucks big time - 1 star"></label>
                        </fieldset>
                        </div>
                        <div class="text-dark">
                          <textarea class="border-0 text-dark text-center" id="testimonial_description_${rowno}" name="testimonials[${rowno}][description]"   placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                  </div>

                </div> `;

        preview_html = `<div class="col-lg-6 pr-8 pl-0 res-pr-0" id="testimonials_${rowno}">
                          <div class="service-card testimonials-card">
                              <div class="service-card-img ">
                                  <img id="testimonial_image${testimonial_image_count}_preview" src="${path}" alt="user" class="img-fluid">
                              </div>
                              <div class="service-card-heading">
                                  <h3>
                                      <span class="stars${rowno}">0</span>/5
                                  </h3>
                                  <span id="stars${rowno}_star" class="star-section d-flex align-items-center justify-content-center">
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  </span>
                                  <p id="testimonial_description_${rowno}_preview">

                                  </p>
                              </div>
                          </div>
                      </div>`;
        testimonial_rating_count++;
        testimonial_image_count++;
        rowno++;
    }

    if (element_type == "social_links") {
        //alert("hii");
        html = `<tr id="inputFormRow4" class="inputFormRow">
                <td>
                  <div class="form-icon-user">
                      <span class="currency-icon"><img class="mb-3  mt-2" src="${assets}/black/${element.toLowerCase()}.svg" style="color:#082e7b;"></span>
                      <input type="text" id="social_link_${rowno}" name="socials[${rowno}][${element}]" placeholder="Enter link" class="form-control mb-0 social_href" required/>
                      <input type="hidden" name="socials[${rowno}][id]" value=${rowno}><br>
                        <h6 class="text-danger text-xs" id="social_link_${rowno}_error_href"></h6>
                  </div>
                </td>
                <td class="text-right">
                    <a class="delete-icon" id="removeRow_socials" data-id="socials_${rowno}"><i class="fas fa-trash"></i></a>
                </td>
              </tr>`;

        if (theme_type == 'theme1') {
            preview_html = `
                      <div class="col-2 socials_${rowno}" id="socials_${rowno}">
                      <span>
                        <a href="#" id="social_link_${rowno}_href_preview" class="social_link_${rowno}_href_preview"  target="_blank">
                            <div class="image-icon">
                                <img src="${path}/${color}/${element.toLowerCase()}.svg" alt="twitter" class="img-fluid">
                            </div>
                        </a>
                    </span>
                    </div>`;
            $(".inputrow_socials_preview").append(preview_html);
        }
        if (theme_type == 'theme2') {
            preview_html = `<div class="col-3 social-image-icon socials_${rowno}" id="socials_${rowno}">
                                <a href="#" id="social_link_${rowno}_href_preview" class="social_link_${rowno}_href_preview"  target="_blank">
                                    <img src="${path}/${color}/social/${element.toLowerCase()}.svg" alt="${element.toLowerCase()}"
                                        class="img-fluid hover-hide">
                                    <img src="${path}/${color}/social/${element.toLowerCase()}.svg" alt="${element.toLowerCase()}"
                                        class="img-fluid hover-show">
                                </a>
                        </div>`;
            social_preview_html = `<div class="col-2 socials_${rowno}" id="socials_${rowno}">
                                <span>
                                  <a href="#" id="social_link_${rowno}_href_preview" class="social_link_${rowno}_href_preview"  target="_blank">
                                      <div class="image-icon">
                                          <img src="${path}/black/${element}.svg" alt="${element}" class="img-fluid">
                                      </div>
                                  </a>
                                </span>
                              </div>
                                `;
            $(".inputrow_socials_preview").append(social_preview_html);
        }

        if (theme_type == 'theme3') {
            preview_html = `<div class="social-image-icon socials_${rowno}">
                          <a href="#" class="social_link_${rowno}_href_preview" id="social_link_${rowno}_href_preview" target="_blank">
                              <img src="${path}/social/${element.toLowerCase()}.svg" alt="${element}"
                                  class="img-fluid">
                          </a>
                      </div>`;
            $(".inputrow_socials_preview").append(preview_html);
        }
        if (theme_type == 'theme4') {
           
            preview_html = `<div class="col-2 socials_${rowno}" id="socials_${rowno}">
              <div class="social-image-icon">
                  <a href="#" class="social_link_${rowno}_href_preview" id="social_link_${rowno}_href_preview" target="_blank">
                      <img src="${path}/${color}/social/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                  </a>
              </div>
          </div>`;

            $(".inputrow_socials_preview").append(preview_html);
        }
        if (theme_type == 'theme5') {
           
           
            preview_html = `<div class="col-3 socials_${rowno}" id="socials_${rowno}">
              <div class="social-image-icon">
                  <a href="#" class="social_link_${rowno}_href_preview" id="social_link_${rowno}_href_preview" target="_blank">
                      <img src="${path}/${color}/social/${element.toLowerCase()}.svg" class="img-fluid">
                  </a>
              </div>
          </div>`;

            $(".inputrow_socials_preview").append(preview_html);
        }
        if (theme_type == 'theme6') {
            
            preview_html = `<div class="col-3 socials_${rowno}" id="socials_${rowno}">
              <div class="social-image-icon">
                  <a href="#" class="social_link_${rowno}_href_preview" id="social_link_${rowno}_href_preview" target="_blank">
                      <img src="${path}/${color}/social/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                  </a>
              </div>
          </div>`;

            $(".inputrow_socials_preview").append(preview_html);
        }
        if (theme_type == 'theme7') {
            preview_html = `<div class="col-2 socials_${rowno}" id="socials_${rowno}">
                <div class="social-image-icon">
                    <a href="#"  class="social_link_${rowno}_href_preview" id="social_link_${rowno}_href_preview" target="_blank">
                        <img src="${path}/${color}/social/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                    </a>
                </div>
            </div>`;
            $(".inputrow_socials_preview").append(preview_html);
        }
        if (theme_type == 'theme8') {
           

            preview_html = `<li class="d-flex align-items-center justify-content-start  socials_${rowno}" id="socials_${rowno}">
                <div class="left-section">
                    <div class="left-images">
                        <img src="${path}/${color}/social/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                    </div>
                </div>
                <div class="contact-text">
                    <h4  class="social_link_${rowno}_href_preview" id="social_link_${rowno}_href_preview">https://demo.rajodiya.com/</h4>
                    <span>${element}</span>
                </div>
            </li>`;

            $(".inputrow_socials_preview").append(preview_html);
        }
        if (theme_type == 'theme9') {
           
            preview_html = `<div class="col-2 socials_${rowno}" id="socials_${rowno}">
            <div class="social-image-icon">
                <a href="#"  class="social_link_${rowno}_href_preview" id="social_link_${rowno}_href_preview" target="_blank">
                    <img src="${path}/social/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                </a>
            </div>
        </div>`;


            $(".inputrow_socials_preview").append(preview_html);
        }
        if (theme_type == 'theme10') {
        
            preview_html = `<div class="col-3 socials_${rowno}" id="socials_${rowno}">
            <div class="social-image-icon">
                <a href="#"  class="social_link_${rowno}_href_preview" id="social_link_${rowno}_href_preview" target="_blank">
                    <img src="${path}/${color}/social/${element.toLowerCase()}.svg" alt="${element}" class="img-fluid">
                </a>
            </div>
        </div>`;


            $(".inputrow_socials_preview").append(preview_html);
        }
        rowno++;

        $("#socialsModal").modal('hide');

    }

    $(`#${divid}`).append(html);
    $(`#${divid}_preview`).append(preview_html);
    if (element_type == "contact") {
        checkcount('hide');
    }
    $("input").keyup(function() {
        var id = $(this).attr('id');
        //console.log(id);
        var preview = $(`#${id}`).val();
        $(`#${id}_preview`).text(preview);
    });

    $("textarea").keyup(function() {
        var id = $(this).attr('id');
        //console.log(id);
        var preview = $(`#${id}`).val();
        $(`#${id}_preview`).text(preview);
    });
    $(".social_href").keyup(function() {
        var id = $(this).attr('id');
        //console.log(id);
        var preview = $(`#${id}`).val();
        var h_preview = validURL(preview);
        //console.log(h_preview);
        if (h_preview == true) {
            $(`#${id}_error_href`).text("");
            $(`.${id}_href_preview`).attr("href", preview);
        } else {
            $(`#${id}_error_href`).text("Please enter valid link");
            $(`#${id}_href_preview`).attr("href", "#");
        }
        //var h_preview = `{{ url("") }}/${preview}`;

    });




    return rowno;
}

/*$(document).on('click', '#removeRow', function () {

    if($(this).data('id') == "testimonials"){
      $(this).closest('#inputFormRow3').remove();
    }
    if($(this).data('id') == "socials"){
      $(this).closest('#inputFormRow4').remove();
    }
});*/

function validURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
        '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
    return !!pattern.test(str);
}
$(document).on('click', '#removeRow_contact', function() {
    var this_id = $(this).data('id');
    $(`#${this_id}`).remove();
    $(this).closest('#inputFormRow').remove();
    checkcount('show');

});

$(document).on('click', '#removeRow_appointment', function() {
    var this_id = $(this).data('id');
    $(`#${this_id}`).remove();
    $(this).closest('#inputFormRow1').remove();

});

$(document).on('click', '#removeRow_services', function() {
    var this_id = $(this).data('id');
    $(`#${this_id}`).remove();
    $(this).closest('#inputFormRow2').remove();

});

$(document).on('click', '#removeRow_testimonials', function() {
    var this_id = $(this).data('id');
    $(`#${this_id}`).remove();
    $(this).closest('#inputFormRow3').remove();

});

$(document).on('click', '#removeRow_socials', function() {
    var this_id = $(this).data('id');
    $(`.${this_id}`).remove();
    $(this).closest('#inputFormRow4').remove();

});