$(document).ready(function() {
    //data table will be display open
    var slug_id = $('#u_org_organization_id').val();
    console.log('organization id is calling here ' + slug_id);
    var dt = $('#wizardTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": '/api/v1/j/wizard_project/index/' + slug_id,
            "dataSrc": 'data',
            "type": "GET",
            "datatype": "json",
            "crossDomain": true,
            "beforeSend": function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem(
                    'a_u_a_b_t'));
            }
        },
        processing: true,
        language: {
            processing: "<img src='../../../../assets/images/loader.gif' style='z-index:1071;background-color:white;border-radius:8pt;padding-top:4pt;padding-bottom:4pt;position:fixed;top:0;right:0;bottom:0;left:0;margin:auto;'>"
        },
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        rowReorder: false,
        columnDefs: [
            { "title": "ID", "targets": 0, "width": "10%" },
            { "title": "Skip Input", "targets": 1, "width": "20%" },
            { "title": "Project Name", "targets": 2, "width": "20%" },
            { "title": "facebook", "targets": 3, "width": "10%" },
            { "title": "Action", "targets": 4, "width": "20%" },
        ],
        columns: [{
                data: 'id'
            },
            // {
            //     data: 'count_null_value'
            // },
            {
                data: null,
                render: function(data, type, row) {
                    if (row.count_null_value == '0/50') {
                        return '<span class="badge badge-pill badge-success">' + data[
                            'count_null_value'] + '</span> <span class="badge badge-pill badge-success"> complete </span>';
                    } else {
                        return '<span class="badge badge-pill badge-danger">' + data[
                            'count_null_value'] + '</span> <span class="badge badge-pill badge-danger"> incomplete </span>';
                    }
                }
            },
            {
                data: 'project_name'
            },
            {
                data: 'facebook'
            },

            {
                data: null,
                render: function(data, type, row) {
                    return '<div class="row"><div class="col-3"><button type="button"  id="' + data['id'] + '" class="editWizardBtn btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div><div class="col-3"><button type="button" id="' + data['id'] + '" class="btn btn-info viewAllValueModalLong"><i class="fa fa-eye"></i></button></div> </div>'
                },
            },
        ],


    });
    // data table close
    //data table will be display close

    // if value does not empty input will be hide open
    $('#project_name').on('change', function() {
        if ($('#project_name').val() != '') {
            $('#errNm1').hide();
        }
    });



    //################################# facebook input and  url formate validation open ###############################
    $('#facebook_url_id').on('change', function() {
        if ($('#facebook_url_id').val() != '') {
            var fb_validate_url = $('#facebook_url_id').val();
            $('#class_err').hide();
            var pattern_fb = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_fb.test(fb_validate_url)) {
                $('#fb_url_error').hide();
                $('.next-step1').removeAttr('disabled', 'disabled');

            } else {
                $("#fb_url_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step1').attr('disabled', 'disabled');

            }
        }
    });

    //###################################### facebook input and  url formate validation close ################################
    //###################################### LinkedIn input and  url formate validation open ################################
    $('#linkedIn_url_id').on('change', function() {
        if ($('#linkedIn_url_id').val() != '') {
            var linkdIn_validate_url = $('#linkedIn_url_id').val();
            $('#errNm_linkedIn').hide();
            var pattern_linkIn = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_linkIn.test(linkdIn_validate_url)) {
                $('#linkedIn_url_validate_error').hide();
                $('.next-step1').removeAttr('disabled', 'disabled');
            } else {
                $("#linkedIn_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step1').attr('disabled', 'disabled');

            }
        }
    });
    // function linkedIn_url(linkdIn_validate_url) {
    //     console.log("now checking url in linkdIn validate url function : "+linkdIn_validate_url);
    //     // Regex pattern for checking
    //     var pattern = /^https:\/\//i;
    //     // Check if pattern is there in the string
    //     if (pattern.test(linkdIn_validate_url)) {
    //         console.log(" in if condition LinkedIn url checked successfully");
    //         // result.innerText = "true";
    //         $('#linkedIn_url_validate_error').hide();
    //     }
    //     else {
    //         console.log(" else condition false In linkedIn");
    //         // result.innerText = "false";
    //         $('#linkedIn_url_validate_error').show();
    //     }
    // }
    //###################################### LinkedIn only url formate validation close ################################

    //###################################### twitter input and url formate validation open ###########################
    $('#twitter_url_id').on('change', function() {
        if ($('#twitter_url_id').val() != '') {
            $('#errNm3').hide();
            var twitter_validate_url = $('#twitter_url_id').val();
            var pattern_linkIn = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_linkIn.test(twitter_validate_url)) {
                $('#twitter_url_validate_error').hide();
                $('.next-step1').removeAttr('disabled', 'disabled');
            } else {
                $("#twitter_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step1').attr('disabled', 'disabled');

            }
        }
    });
    //###################################### twitter input and url formate validation close ###########################

    //###################################### instagram input and url formate validation open ###########################
    $('#instagram_url_id').on('change', function() {
        if ($('#instagram_url_id').val() != '') {
            $('#errNm4').hide();
            var instagram_validate_url = $('#instagram_url_id').val();
            var pattern_linkIn = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_linkIn.test(instagram_validate_url)) {
                $('#instagram_url_validate_error').hide();
                $('.next-step1').removeAttr('disabled', 'disabled');
            } else {
                $("#instagram_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step1').attr('disabled', 'disabled');

            }
        }
    });
    //###################################### instagram input and url formate validation close ###########################

    //###################################### youtube input and url formate validation open ###########################
    $('#youtube_url_id').on('change', function() {
        if ($('#youtube_url_id').val() != '') {
            $('#errNm5').hide();
            var youtube_validate_url = $('#youtube_url_id').val();
            var pattern_youtube = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_youtube.test(youtube_validate_url)) {
                $('#youtube_url_validate_error').hide();
                $('.next-step1').removeAttr('disabled', 'disabled');
            } else {
                $("#youtube_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step1').attr('disabled', 'disabled');

            }
        }
    });
    //###################################### youtube input and url formate validation close ###########################



    $('#pinterest_url_id').on('change', function() {
        if ($('#pinterest_url_id').val() != '') {
            $('#errNm6').hide();
        }
    });
    //###################################### reddit input and url formate validation open ###########################

    $('#reddit_url_id').on('change', function() {
        if ($('#reddit_url_id').val() != '') {
            $('#errRediit_url').hide();
            var reddit_validate_url = $('#reddit_url_id').val();
            var pattern_reddit = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_reddit.test(reddit_validate_url)) {
                $('#reddit_url_validate_error').hide();
                $('.next-step2').removeAttr('disabled', 'disabled');
            } else {
                $("#reddit_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step2').attr('disabled', 'disabled');

            }
        }
    });
    //###################################### reddit input and url formate validation close ###########################

    //###################################### tumblr input and url formate validation open ###########################
    $('#tumblr_url_id').on('change', function() {
        if ($('#tumblr_url_id').val() != '') {
            $('#errNm7').hide();
            // url validation open
            var tumblr_validate_url = $('#tumblr_url_id').val();
            var pattern_tumblr = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_tumblr.test(tumblr_validate_url)) {
                $('#tumblr_url_validate_error').hide();
                $('.next-step2').removeAttr('disabled', 'disabled');
            } else {
                $("#tumblr_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step2').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### tumblr input and url formate validation close ###########################

    //###################################### plurk input and url formate validation open ###########################
    $('#plurk_url_id').on('change', function() {
        if ($('#plurk_url_id').val() != '') {
            $('#errNm8').hide();
            // url validation open
            var plurk_validate_url = $('#plurk_url_id').val();
            var pattern_plurk = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_plurk.test(plurk_validate_url)) {
                $('#plurk_url_validate_error').hide();
                $('.next-step2').removeAttr('disabled', 'disabled');
            } else {
                $("#plurk_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step2').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### plurk input and url formate validation close ##############################

    //###################################### getpocket input and url formate validation open ###########################
    $('#getpocket_url_id').on('change', function() {
        if ($('#getpocket_url_id').val() != '') {
            $('#errNm9').hide();
            // url validation open
            var getpocket_validate_url = $('#getpocket_url_id').val();
            var pattern_getpocket = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_getpocket.test(getpocket_validate_url)) {
                $('#getpocket_url_validate_error').hide();
                $('.next-step2').removeAttr('disabled', 'disabled');
            } else {
                $("#getpocket_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step2').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });

    //###################################### getpocket input and url formate validation close ###########################

    //###################################### wiz input and url formate validation open ###########################
    $('#wix_url_id').on('change', function() {
        if ($('#wix_url_id').val() != '') {
            $('#errNm10').hide();
            // url validation open
            var wix_validate_url = $('#wix_url_id').val();
            var pattern_wix = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_wix.test(wix_validate_url)) {
                $('#wix_url_validate_error').hide();
                $('.next-step3').removeAttr('disabled', 'disabled');
            } else {
                $("#wix_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step3').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### wiz input and url formate validation close ###########################

    //###################################### wordpress input and url formate validation open ############################
    $('#wordpress_url_id').on('change', function() {
        if ($('#wordpress_url_id').val() != '') {
            $('#errNm_wordpress').hide();
            // url validation open
            var wordpress_validate_url = $('#wordpress_url_id').val();
            var pattern_wordpress = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_wordpress.test(wordpress_validate_url)) {
                $('#wordpress_url_validate_error').hide();
                $('.next-step3').removeAttr('disabled', 'disabled');
            } else {
                $("#wordpress_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step3').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### wordpress input and url formate validation close ###########################

    //###################################### weebly input and url formate validation open ###############################
    $('#weebly_url_id').on('change', function() {
        if ($('#weebly_url_id').val() != '') {
            $('#errNm_weebly').hide();
            // url validation open
            var weebly_validate_url = $('#weebly_url_id').val();
            var pattern_weebly = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_weebly.test(weebly_validate_url)) {
                $('#weebly_url_validate_error').hide();
                $('.next-step3').removeAttr('disabled', 'disabled');
            } else {
                $("#weebly_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step3').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### weebly input and url formate validation close ##############################

    //###################################### medium input and url formate validation open ###############################
    $('#medium_url_id').on('change', function() {
        if ($('#medium_url_id').val() != '') {
            $('#errNm_medium').hide();
            // url validation open
            var medium_validate_url = $('#medium_url_id').val();
            var pattern_medium = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_medium.test(medium_validate_url)) {
                $('#medium_url_validate_error').hide();
                $('.next-step3').removeAttr('disabled', 'disabled');
            } else {
                $("#medium_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step3').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### medium input and url formate validation close ##############################

    //###################################### professnow input and url formate validation open ##############################
    $('#professnow_url_id').on('change', function() {
        if ($('#professnow_url_id').val() != '') {
            $('#errNm_professnow').hide();
            // url validation open
            var professnow_validate_url = $('#professnow_url_id').val();
            var pattern_professnow = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_professnow.test(professnow_validate_url)) {
                $('#professnow_url_validate_error').hide();
                $('.next-step3').removeAttr('disabled', 'disabled');
            } else {
                $("#professnow_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step3').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### professnow input and url formate validation close ##############################
    //###################################### github input and url formate validation open ##############################
    $('#github_url_id').on('change', function() {
        if ($('#github_url_id').val() != '') {
            $('#errNm_github').hide();
            // url validation open
            var github_validate_url = $('#github_url_id').val();
            var pattern_github = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_github.test(github_validate_url)) {
                $('#github_url_validate_error').hide();
                $('.next-step4').removeAttr('disabled', 'disabled');
            } else {
                $("#github_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step4').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### github input and url formate validation close ##############################
    //###################################### hubpages input and url formate validation open ##############################
    $('#hubpages_url_id').on('change', function() {
        if ($('#hubpages_url_id').val() != '') {
            $('#errNm_hubpages').hide();
            // url validation open
            var hubpages_validate_url = $('#hubpages_url_id').val();
            var pattern_hubpages = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_hubpages.test(hubpages_validate_url)) {
                $('#hubpages_url_validate_error').hide();
                $('.next-step4').removeAttr('disabled', 'disabled');
            } else {
                $("#hubpages_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step4').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### hubpages input and url formate validation close ##############################
    //###################################### ehow input and url formate validation open ##############################
    $('#ehow_url_id').on('change', function() {
        if ($('#ehow_url_id').val() != '') {
            $('#errNm_ehow_step_4').hide();
            // url validation open
            var ehow_validate_url = $('#ehow_url_id').val();
            var pattern_ehow = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_ehow.test(ehow_validate_url)) {
                $('#ehow_url_validate_error').hide();
                $('.next-step4').removeAttr('disabled', 'disabled');
            } else {
                $("#ehow_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step4').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### ehow input and url formate validation close ##############################
    //###################################### dzone input and url formate validation open ##############################
    $('#dzone_url_id').on('change', function() {
        if ($('#dzone_url_id').val() != '') {
            $('#errNm_dzone').hide();
            // url validation open
            var dzone_validate_url = $('#dzone_url_id').val();
            var pattern_dzone = /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (pattern_dzone.test(dzone_validate_url)) {
                $('#dzone_url_validate_error').hide();
                $('.next-step4').removeAttr('disabled', 'disabled');
            } else {
                $("#dzone_url_validate_error").html("Please enter a valid URL format (https:// or http://)");
                $('.next-step4').attr('disabled', 'disabled');
            }
            // url validation close
        }
    });
    //###################################### dzone input and url formate validation close ##############################
    //######################################  articlesfactory input and url formate validation open ##############################
    //######################################  articlesfactory input and url formate validation close ##############################

    $('#articlesfactory_url_id').on('change', function() {
        if ($('#articlesfactory_url_id').val() != '') {
            $('#errNm_articlesfactory').hide();
        }
    }); // step-4 validationo close

    // step-5 validation open
    $('#justdial_url_id').on('change', function() {
        if ($('#justdial_url_id').val() != '') {
            $('#errNm_justdial').hide();
        }
    });
    $('#sulekha_url_id').on('change', function() {
        if ($('#sulekha_url_id').val() != '') {
            $('#errNm_sulekha').hide();
        }
    });
    $('#indiamart_url_id').on('change', function() {
        if ($('#indiamart_url_id').val() != '') {
            $('#errNm_indiamart').hide();
        }
    });
    $('#quikr_url_id').on('change', function() {
        if ($('#quikr_url_id').val() != '') {
            $('#errNm_quikr').hide();
        }
    });
    $('#click_url_id').on('change', function() {
        if ($('#click_url_id').val() != '') {
            $('#errNm_click').hide();
        }
    });
    // step-5 validation close

    // step-6 validation open

    $('#quora_url_id').on('change', function() {
        if ($('#quora_url_id').val() != '') {
            $('#errNm_quora').hide();
        }
    });
    $('#wikibooks_url_id').on('change', function() {
        if ($('#wikibooks_url_id').val() != '') {
            $('#errNm_wikibooks').hide();
        }
    });
    $('#answers_url_id').on('change', function() {
        if ($('#answers_url_id').val() != '') {
            $('#errNm_answers').hide();
        }
    });

    $('#superuser_url_id').on('change', function() {
        if ($('#superuser_url_id').val() != '') {
            $('#errNm_superuser').hide();
        }
    });
    // step-6 validation close

    // step-7 validation open
    $('#dailymotion_url_id').on('change', function() {
        if ($('#dailymotion_url_id').val() != '') {
            $('#errNm_dailymotion').hide();
        }
    });
    $('#vimeo_url_id').on('change', function() {
        if ($('#vimeo_url_id').val() != '') {
            $('#errNm_vimeo').hide();
        }
    });
    $('#metacafe_url_id').on('change', function() {
        if ($('#metacafe_url_id').val() != '') {
            $('#errNm_metacafe').hide();
        }
    });
    $('#dropshots_url_id').on('change', function() {
        if ($('#dropshots_url_id').val() != '') {
            $('#errNm_dropshots').hide();
        }
    });
    // step-7 validation close

    // step-8 validation open
    $('#mediafire_url_id').on('change', function() {
        if ($('#mediafire_url_id').val() != '') {
            $('#errNm_mediafire').hide();
        }
    });
    $('#slideshare_url_id').on('change', function() {
        if ($('#slideshare_url_id').val() != '') {
            $('#errNm_slideshare').hide();
        }
    });
    $('#scribd_url_id').on('change', function() {
        if ($('#scribd_url_id').val() != '') {
            $('#errNm_scribd').hide();
        }
    });
    $('#4shared_url_id').on('change', function() {
        if ($('#4shared_url_id').val() != '') {
            $('#errNm_4shared').hide();
        }
    });
    $('#issuu_url_id').on('change', function() {
        if ($('#issuu_url_id').val() != '') {
            $('#errNm_issuu').hide();
        }
    });
    // step-8 validation close
    // step-9 validation open

    $('#freeadstime_url_id').on('change', function() {
        if ($('#freeadstime_url_id').val() != '') {
            $('#errNm_freeadstime').hide();
        }
    });
    $('#superadpost_url_id').on('change', function() {
        if ($('#superadpost_url_id').val() != '') {
            $('#errNm_superadpost').hide();
        }
    });
    $('#findermaster_url_id').on('change', function() {
        if ($('#findermaster_url_id').val() != '') {
            $('#errNm_findermaster').hide();
        }
    });
    $('#mastermoz_url_id').on('change', function() {
        if ($('#mastermoz_url_id').val() != '') {
            $('#errNm_mastermoz').hide();
        }
    });
    $('#h1ad_url_id').on('change', function() {
        if ($('#h1ad_url_id').val() != '') {
            $('#errNm_h1ad').hide();
        }
    });
    // step-9 validation close
    // step-10 validation open

    $('#imgur_url_id').on('change', function() {
        if ($('#imgur_url_id').val() != '') {
            $('#errNm_imgur').hide();
        }
    });

    $('#flickr_url_id').on('change', function() {
        if ($('#flickr_url_id').val() != '') {
            $('#err_flickr').hide();
        }
    });
    // step-10 validation close

    //############################################# if value does not empty input will be hide close ######################

    // ########################################### input skip function open  ##############################################

    $('#skip_facebook_id').on('click', function() {
        $('#facebook_form').hide();
        $('#facebook_url_id').val('skiped');
        $('.next-step1').removeAttr('disabled', 'disabled');
    });
    $('#skip_linkedIn_id').on('click', function() {
        $('#linkedIn_form').hide();
        $('#linkedIn_url_id').val('skiped');
        $('.next-step1').removeAttr('disabled', 'disabled');
    });
    $('#skip_twitter_id').on('click', function() {
        $('#twitter_url_id_form').hide();
        $('#twitter_url_id').val('skiped');
        $('.next-step1').removeAttr('disabled', 'disabled');
    });
    $('#skip_instagram_id').on('click', function() {
        $('#instagram_url_id_form').hide();
        $('#instagram_url_id').val('skiped');
        $('.next-step1').removeAttr('disabled', 'disabled');
    });
    $('#skip_youtube_id').on('click', function() {
        $('#youtube_url_id_form').hide();
        $('#youtube_url_id').val('skiped');
        $('.next-step1').removeAttr('disabled', 'disabled');
    });

    // $('#skip_reddit_id').on('click', function () {
    //     $('#reddit_form').hide();
    //     $('#reddit_url_id').val('skiped');
    // });
    $('#skip_reddit_id').on('click', function() {
        $('#reddit_form').hide();
        $('#reddit_url_id').val('skiped');
        $('.next-step2').removeAttr('disabled', 'disabled');
    });

    $('#skip_tumblr_id').on('click', function() {
        $('#tumblr_url_id_form').hide();
        $('#tumblr_url_id').val('skiped');
        $('.next-step2').removeAttr('disabled', 'disabled');
    });
    $('#skip_plurk_id').on('click', function() {
        $('#plurk_url_id_form').hide();
        $('#plurk_url_id').val('skiped');
        $('.next-step2').removeAttr('disabled', 'disabled');

    });
    $('#skip_getpocket_id').on('click', function() {
        $('#getpocket_url_id_form').hide();
        $('#getpocket_url_id').val('skiped');
        $('.next-step2').removeAttr('disabled', 'disabled');
    });
    $('#skip_wix_id').on('click', function() {
        $('#wix_blog_form').hide();
        $('#wix_url_id').val('skiped');
        $('.next-step3').removeAttr('disabled', 'disabled');
    });

    $('#skip_wordpress_id').on('click', function() {
        $('#wordpress_blog_form').hide();
        $('#wordpress_url_id').val('skiped');
        $('.next-step3').removeAttr('disabled', 'disabled');
    });

    $('#skip_weebly_id').on('click', function() {
        $('#weebly_blog_form').hide();
        $('#weebly_url_id').val('skiped');
        $('.next-step3').removeAttr('disabled', 'disabled');
    });
    $('#skip_medium_id').on('click', function() {
        $('#medium_blog_form').hide();
        $('#medium_url_id').val('skiped');
        $('.next-step3').removeAttr('disabled', 'disabled');
    });
    $('#skip_professnow_id').on('click', function() {
        $('#professnow_blog_form').hide();
        $('#professnow_url_id').val('skiped');
        $('.next-step3').removeAttr('disabled', 'disabled');
    });
    $('#skip_github_id').on('click', function() {
        $('#github_blog_form').hide();
        $('#github_url_id').val('skiped');
        $('.next-step4').removeAttr('disabled', 'disabled');
    });
    $('#skip_hubpages_id').on('click', function() {
        $('#hubpages_blog_form').hide();
        $('#hubpages_url_id').val('skiped');
        $('.next-step4').removeAttr('disabled', 'disabled');
    });
    $('#skip_ehow_id').on('click', function() {
        $('#ehow_blog_form').hide();
        $('#ehow_url_id').val('skiped');
        $('.next-step4').removeAttr('disabled', 'disabled');
    });
    $('#skip_dzone_id').on('click', function() {
        $('#dzone_blog_form').hide();
        $('#dzone_url_id').val('skiped');
        $('.next-step4').removeAttr('disabled', 'disabled');
    });
    $('#skip_articlesfactory_id').on('click', function() {
        $('#articlesfactory_blog_form').hide();
        $('#articlesfactory_url_id').val('skiped');
        $('.next-step4').removeAttr('disabled', 'disabled');
    });
    $('#skip_justdial_id').on('click', function() {
        $('#justdial_blog_form').hide();
        $('#justdial_url_id').val('skiped');
        $('.next-step5').removeAttr('disabled', 'disabled');
    });
    $('#skip_sulekha_id').on('click', function() {
        $('#sulekha_blog_form').hide();
        $('#sulekha_url_id').val('skiped');
        $('.next-step5').removeAttr('disabled', 'disabled');
    });

    $('#skip_indiamart_id').on('click', function() {
        $('#indiamart_blog_form').hide();
        $('#indiamart_url_id').val('skiped');
        $('.next-step5').removeAttr('disabled', 'disabled');
    });
    $('#skip_quikr_id').on('click', function() {
        $('#quikr_blog_form').hide();
        $('#quikr_url_id').val('skiped');
        $('.next-step5').removeAttr('disabled', 'disabled');
    });
    $('#skip_click_id').on('click', function() {
        $('#click_blog_form').hide();
        $('#click_url_id').val('skiped');
        $('.next-step5').removeAttr('disabled', 'disabled');
    });

    $('#skip_quora_id').on('click', function() {
        $('#quora_blog_form').hide();
        $('#quora_url_id').val('skiped');
        $('.next-step6').removeAttr('disabled', 'disabled');
    });

    $('#skip_wikibooks_id').on('click', function() {
        $('#wikibooks_blog_form').hide();
        $('#wikibooks_url_id').val('skiped');
        $('.next-step6').removeAttr('disabled', 'disabled');
    });

    $('#skip_answers_id').on('click', function() {
        $('#answers_blog_form').hide();
        $('#answers_url_id').val('skiped');
        $('.next-step6').removeAttr('disabled', 'disabled');
    });

    $('#skip_superuser_id').on('click', function() {
        $('#superuser_blog_form').hide();
        $('#superuser_url_id').val('skiped');
        $('.next-step6').removeAttr('disabled', 'disabled');
    });

    $('#skip_dailymotion_id').on('click', function() {
        $('#dailymotion_blog_form').hide();
        $('#dailymotion_url_id').val('skiped');
        $('.next-step7').removeAttr('disabled', 'disabled');
    });
    $('#skip_vimeo_id').on('click', function() {
        $('#vimeo_blog_form').hide();
        $('#vimeo_url_id').val('skiped');
        $('.next-step7').removeAttr('disabled', 'disabled');
    });
    $('#skip_metacafe_id').on('click', function() {
        $('#metacafe_blog_form').hide();
        $('#metacafe_url_id').val('skiped');
        $('.next-step7').removeAttr('disabled', 'disabled');
    });
    $('#skip_dropshots_id').on('click', function() {
        $('#dropshots_blog_form').hide();
        $('#dropshots_url_id').val('skiped');
        $('.next-step7').removeAttr('disabled', 'disabled');
    });
    $('#skip_mediafire_id').on('click', function() {
        $('#mediafire_form').hide();
        $('#mediafire_url_id').val('skiped');
        $('.next-step8').removeAttr('disabled', 'disabled');
    });
    $('#skip_mediafire_id').on('click', function() {
        $('#mediafire_form').hide();
        $('#mediafire_url_id').val('skiped');
        $('.next-step8').removeAttr('disabled', 'disabled');
    });
    $('#skip_slideshare_id').on('click', function() {
        $('#slideshare_form').hide();
        $('#slideshare_url_id').val('skiped');
        $('.next-step8').removeAttr('disabled', 'disabled');
    });
    $('#skip_scribd_id').on('click', function() {
        $('#scribd_blog_form').hide();
        $('#scribd_url_id').val('skiped');
        $('.next-step8').removeAttr('disabled', 'disabled');
    });
    $('#skip_four_shared_id').on('click', function() {
        $('#4shared_blog_form').hide();
        $('#4shared_url_id').val('skiped');
        $('.next-step8').removeAttr('disabled', 'disabled');
    });
    $('#skip_issuu_id').on('click', function() {
        $('#issuu_form').hide();
        $('#issuu_url_id').val('skiped');
        $('.next-step8').removeAttr('disabled', 'disabled');
    });
    $('#skip_freeadstime_id').on('click', function() {
        $('#freeadstime_form').hide();
        $('#freeadstime_url_id').val('skiped');
        $('.next-step9').removeAttr('disabled', 'disabled');
    });
    $('#skip_superadpost_id').on('click', function() {
        $('#superadpost_form').hide();
        $('#superadpost_url_id').val('skiped');
        $('.next-step9').removeAttr('disabled', 'disabled');
    });
    $('#skip_findermaster_id').on('click', function() {
        $('#findermaster_blog_form').hide();
        $('#findermaster_url_id').val('skiped');
        $('.next-step9').removeAttr('disabled', 'disabled');
    });
    $('#skip_mastermoz_id').on('click', function() {
        $('#mastermoz_blog_form').hide();
        $('#mastermoz_url_id').val('skiped');
        $('.next-step9').removeAttr('disabled', 'disabled');
    });
    $('#skip_h1ad_id').on('click', function() {
        $('#h1ad_form').hide();
        $('#h1ad_url_id').val('skiped');
        $('.next-step9').removeAttr('disabled', 'disabled');
    });

    $('#skip_imgur_id').on('click', function() {
        $('#imgur_form').hide();
        $('#imgur_url_id').val('skiped');
        $('.next-step10').removeAttr('disabled', 'disabled');
    });
    $('#skip_flickr_id').on('click', function() {
        $('#flickr_form').hide();
        $('#flickr_url_id').val('skiped');
        $('.next-step10').removeAttr('disabled', 'disabled');
    });


    // ########################################### input skip function close  ##############################################
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        var $target = $(e.target);
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step1").click(function(e) {
        console.log('project_wizzard js me hai step 1');
        if ($.trim($('#project_name').val()) == '' || $.trim($('#facebook_url_id').val()) == '' ||
            $.trim($('#linkedIn_url_id').val()) == '' || $.trim($('#twitter_url_id').val()) == '' ||
            $.trim($('#instagram_url_id').val()) == '' || $.trim($('#youtube_url_id').val()) == '') {
            var focusSet = true;

            if (!$('#project_name').val()) {
                if ($("#project_name").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm1").html("Please field project name");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#project_name').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#project_name").parent().next(".validation").remove();
                // remove it
            }
            if (!$('#facebook_url_id').val()) {
                if ($("#facebook_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#class_err").html("Please Fill required field");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#facebook_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#facebook_url_id").parent().next(".validation").remove();
                // remove it
            }

            // linkdin url input field open
            if (!$('#linkedIn_url_id').val()) {
                if ($("#linkedIn_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_linkedIn").html("Please Fill linkedIn url");
                    // $("#linkedIn_url_validate_error").html("Please enter linkedIn link format (https:// or http://)");
                }
                e.preventDefault(); // prevent form from POST to server errNm linkedIn
                $('#linkedIn_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#linkedIn_url_id").parent().next(".validation").remove();
                // remove it
            }
            // linkdin url input field close
            // twitter url input field open
            if (!$('#twitter_url_id').val()) {
                if ($("#twitter_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm3").html("Please Fill twitter url");
                }
                e.preventDefault(); // prevent form from POST to server errNm3
                $('#twitter_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#twitter_url_id").parent().next(".validation").remove();
                // remove it
            }
            // twitter url input field close
            // instagram url input field open
            if (!$('#instagram_url_id').val()) {
                if ($("#instagram_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm4").html("Please Fill instagram url");
                }
                e.preventDefault(); // prevent form from POST to server errNm4
                $('#instagram_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#instagram_url_id").parent().next(".validation").remove();
                // remove it
            }
            // instagram url input field close
            // youtube url input field open
            if (!$('#youtube_url_id').val()) {
                if ($("#youtube_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm5").html("Please Fill youtube url");
                }
                e.preventDefault(); // prevent form from POST to server errNm5
                $('#youtube_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#youtube_url_id").parent().next(".validation").remove();
                // remove it
            }
            // youtube url input field close

        } else {
            var $active = $('.nav-tabs li>.active');
            $active.parent().next().find('.nav-link').removeClass('disabled');
            nextTab($active);
        }
    });

    $(".next-step2").click(function(e) {
        console.log('project_wizzard js me hai step 2');
        if ($.trim($('#pinterest_url_id').val()) == '' || $.trim($('#reddit_url_id').val()) == '' || $.trim($('#tumblr_url_id').val()) == '' || $.trim($('#plurk_url_id').val()) == '' || $.trim($('#getpocket_url_id').val()) == '') {
            var focusSet = false;

            // pinterest url id url input field open
            if (!$('#pinterest_url_id').val()) {
                if ($("#pinterest_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm6").html("Please Fill pinterest url");
                }
                e.preventDefault(); // prevent form from POST to server errNm6
                $('#pinterest_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#pinterest_url_id").parent().next(".validation").remove();
                // remove it
            }
            // pinterest url id url input field close

            // reddit url input field open
            if (!$('#reddit_url_id').val()) {
                if ($("#reddit_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errRediit_url").html("Please Fill reddit url");
                }
                e.preventDefault(); // prevent form from POST to server errRediit_url
                $('#reddit_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#reddit_url_id").parent().next(".validation").remove();
                // remove it
            }
            // reddit url input field close

            // tumblr validation open
            if (!$('#tumblr_url_id').val()) {
                if ($("#tumblr_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm7").html("Please Fill tumblr url");
                }
                e.preventDefault(); // prevent form from POST to server errNm7
                $('#tumblr_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#tumblr_url_id").parent().next(".validation").remove();
                // remove it
            }
            // tumblr validation close
            // plurk url validation open
            if (!$('#plurk_url_id').val()) {
                if ($("#plurk_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm8").html("Please Fill plurk url");
                }
                e.preventDefault(); // prevent form from POST to server errNm8
                $('#plurk_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#plurk_url_id").parent().next(".validation").remove();
                // remove it
            }
            // plurk url validation close

            // wix.com url validation open
            if (!$('#getpocket_url_id').val()) {
                if ($("#getpocket_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm9").html("Please Fill getpocket url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#getpocket_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#getpocket_url_id").parent().next(".validation").remove();
                // remove it
            }
            // wix.com url validation close

        } else {
            var $active = $('.nav-tabs li>.active');
            $active.parent().next().find('.nav-link').removeClass('disabled');
            nextTab($active);
        }
    });
    $(".next-step3").click(function(e) {
        console.log('project_wizzard js me hai step 3');
        if ($.trim($('#wix_url_id').val()) == '' || $.trim($('#wordpress_url_id').val()) == '' || $.trim($('#weebly_url_id').val()) == '' || $.trim($('#medium_url_id').val()) == '' || $.trim($('#professnow_url_id').val()) == '') {
            var focusSet = false;

            if (!$('#wix_url_id').val()) {
                if ($("#wix_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm10").html("Please fill wix.com blog url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#wix_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#wix_url_id").parent().next(".validation").remove();
                // remove it
            }
            // wordpress blog validation page open
            if (!$('#wordpress_url_id').val()) {
                if ($("#wordpress_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_wordpress").html("Please fill wordpress blog site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#wordpress_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#wordpress_url_id").parent().next(".validation").remove();
                // remove it
            }
            // wordpress blog validation page open

            // weebly.com blog validation page open in step-3
            if (!$('#weebly_url_id').val()) {
                if ($("#weebly_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_weebly").html("Please fill weebly blog site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#weebly_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#weebly_url_id").parent().next(".validation").remove();

            }
            // weebly.com blog validation page open in step-3

            // medium.com blog validation page open in step-3
            if (!$('#medium_url_id').val()) {
                if ($("#medium_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_medium").html("Please fill medium blog site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#medium_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#medium_url_id").parent().next(".validation").remove();

            }
            // medium.com blog validation page open in step-3

            // professnow_url_id.com blog validation page open in step-3
            if (!$('#professnow_url_id').val()) {
                if ($("#professnow_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_professnow").html("Please fill professnow blog site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#professnow_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#professnow_url_id").parent().next(".validation").remove();

            }
            // weebly.com blog validation page open in step-3

        } else {
            console.log('step-3 ka document ready hua hai');
            var $active = $('.nav-tabs li>.active');
            $active.parent().next().find('.nav-link').removeClass('disabled');
            nextTab($active);
        }
    });

    // step-4 ajax with validation page open
    $(".next-step4").click(function(e) {
        console.log('project_wizzard js me hai step 4');
        if ($.trim($('#github_url_id').val()) == '' || $.trim($('#hubpages_url_id').val()) == '' || $.trim($('#ehow_url_id').val()) == '' || $.trim($('#dzone_url_id').val()) == '' || $.trim($('#articlesfactory_url_id').val()) == '') {
            var focusSet = false;

            // github_url_id pgae validation open in step-4
            if (!$('#github_url_id').val()) {
                if ($("#github_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_github").html("Please fill githubArticle submission url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#github_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#github_url_id").parent().next(".validation").remove();
                // remove it
            }
            // github_url_id pgae validation close in step-4

            // wordpress blog validation page open in step-4
            if (!$('#hubpages_url_id').val()) {
                if ($("#hubpages_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_hubpages").html("Please fill hubpages url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#hubpages_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#hubpages_url_id").parent().next(".validation").remove();
                // remove it
            }
            // wordpress blog validation page open in step--4

            // weebly.com blog validation page open in step-4
            if (!$('#ehow_url_id').val()) {
                if ($("#ehow_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_ehow_step_4").html("Please fill ehow site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#ehow_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#ehow_url_id").parent().next(".validation").remove();

            }
            // weebly.com blog validation page open in step-4

            // medium.com blog validation page open in step-4
            if (!$('#dzone_url_id').val()) {
                if ($("#dzone_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_dzone").html("Please fill dzone site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#dzone_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#dzone_url_id").parent().next(".validation").remove();

            }
            // medium.com blog validation page open in step-4

            // articlesfactory_url_id.com blog validation page open in step-4
            if (!$('#articlesfactory_url_id').val()) {
                if ($("#articlesfactory_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_articlesfactory").html("Please fill professnow blog site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#articlesfactory_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#articlesfactory_url_id").parent().next(".validation").remove();

            }
            // weebly.com blog validation page open in step-3

        } else {
            console.log('step-4 ka document ready hua hai');
            var $active = $('.nav-tabs li>.active');
            $active.parent().next().find('.nav-link').removeClass('disabled');
            nextTab($active);
        }
    });
    // step-4 ajax with validation page close

    // step-5 ajax with validation page open
    $(".next-step5").click(function(e) {
        console.log('project_wizzard js me hai step 5');
        if ($.trim($('#justdial_url_id').val()) == '' || $.trim($('#sulekha_url_id').val()) == '' || $.trim($('#indiamart_url_id').val()) == '' || $.trim($('#quikr_url_id').val()) == '' || $.trim($('#click_url_id').val()) == '') {
            var focusSet = false;

            // justdial_url_id pgae validation open in step-5
            if (!$('#justdial_url_id').val()) {
                if ($("#justdial_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_justdial").html("Please fill justdial url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#justdial_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#justdial_url_id").parent().next(".validation").remove();
                // remove it
            }
            // justdial_url_id pgae validation close in step-5

            // sulekha blog validation page open in step-5
            if (!$('#sulekha_url_id').val()) {
                if ($("#sulekha_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_sulekha").html("Please fill Hubpages url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#sulekha_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#sulekha_url_id").parent().next(".validation").remove();
                // remove it
            }
            // sulekha blog validation page open in step-5

            // indiamart_url_id.com blog validation page open in step-5
            if (!$('#indiamart_url_id').val()) {
                if ($("#indiamart_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_indiamart").html("Please fill IndiaMart site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#indiamart_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#indiamart_url_id").parent().next(".validation").remove();

            }
            // indiamart.com blog validation page open in step-5

            // medium.com blog validation page open in step-5
            if (!$('#quikr_url_id').val()) {
                if ($("#quikr_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_quikr").html("Please fill quikr site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#quikr_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#quikr_url_id").parent().next(".validation").remove();

            }
            // medium.com blog validation page open in step-5

            // click_url_id.com blog validation page open in step-5
            if (!$('#click_url_id').val()) {
                if ($("#click_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_click").html("Please fill click.in site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#click_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#click_url_id").parent().next(".validation").remove();

            }
            // weebly.com blog validation page open in step-5

        } else {
            console.log('step-5 ka document ready hua hai');
            var $active = $('.nav-tabs li>.active');
            $active.parent().next().find('.nav-link').removeClass('disabled');
            nextTab($active);
        }
    });
    // step-5 ajax with validation page close

    // step-6 ajax with validation page open
    $(".next-step6").click(function(e) {
        console.log('project_wizzard js me hai step 6');
        if ($.trim($('#quora_url_id').val()) == '' || $.trim($('#wikibooks_url_id').val()) == '' || $.trim($('#ehow_url_id').val()) == '' || $.trim($('#answers_url_id').val()) == '' || $.trim($('#superuser_url_id').val()) == '') {
            var focusSet = false;

            // quora url id pgae validation open in step-6
            if (!$('#quora_url_id').val()) {
                if ($("#quora_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_quora").html("Please fill quora url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#quora_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#quora_url_id").parent().next(".validation").remove();
                // remove it
            }
            // quora_url id pgae validation close in step-6

            // sulekha blog validation page open in step-6
            if (!$('#wikibooks_url_id').val()) {
                if ($("#wikibooks_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_wikibooks").html("Please fill wikibooks url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#wikibooks_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#wikibooks_url_id").parent().next(".validation").remove();
                // remove it
            }
            // sulekha blog validation page open in step-6



            // medium.com blog validation page open in step-6
            if (!$('#answers_url_id').val()) {
                if ($("#answers_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_answers").html("Please fill answers site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#answers_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#answers_url_id").parent().next(".validation").remove();

            }
            // medium.com blog validation page open in step-6

            // superuser_url_id.com blog validation page open in step-6
            if (!$('#superuser_url_id').val()) {
                if ($("#superuser_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_superuser").html("Please fill superuser site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#superuser_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#superuser_url_id").parent().next(".validation").remove();

            }
            // weebly.com blog validation page open in step-6

        } else {
            console.log('step-6 ka document ready hua hai');
            var $active = $('.nav-tabs li>.active');
            $active.parent().next().find('.nav-link').removeClass('disabled');
            nextTab($active);
        }
    });
    // step-6 ajax with validation page close

    // step-7 ajax with validation page open
    $(".next-step7").click(function(e) {
        console.log('project_wizzard js me hai step 7');
        if ($.trim($('#dailymotion_url_id').val()) == '' || $.trim($('#vimeo_url_id').val()) == '' || $.trim($('#metacafe_url_id').val()) == '' || $.trim($('#dropshots_url_id').val()) == '') {
            var focusSet = false;

            // youtube_url_id pgae validation open in step-7
            if (!$('#youtube_url_id').val()) {
                if ($("#youtube_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#err_url_youtube").html("Please fill youtube url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#youtube_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#youtube_url_id").parent().next(".validation").remove();
                // remove it
            }

            // youtube_url_id pgae validation close in step-7

            // dailymotion blog validation page open in step-7
            if (!$('#dailymotion_url_id').val()) {
                if ($("#dailymotion_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_dailymotion").html("Please fill dailymotion url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#dailymotion_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#dailymotion_url_id").parent().next(".validation").remove();
                // remove it
            }
            // dailymotion blog validation page open in step-7

            // indiamart.com blog validation page open in step-7
            if (!$('#vimeo_url_id').val()) {
                if ($("#vimeo_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_vimeo").html("Please fill vimeo site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#vimeo_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#vimeo_url_id").parent().next(".validation").remove();

            }
            // vimeo_url_id.com blog validation page open in step-7

            // metacafe_url_id blog validation page open in step-7
            if (!$('#metacafe_url_id').val()) {
                if ($("#metacafe_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_metacafe").html("Please fill metacafe site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#metacafe_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#metacafe_url_id").parent().next(".validation").remove();

            }
            // metacafe_url_id blog validation page open in step-7

            // dropshots  validation page open in step-7
            if (!$('#dropshots_url_id').val()) {
                if ($("#dropshots_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_dropshots").html("Please fill dropshots site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#dropshots_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#dropshots_url_id").parent().next(".validation").remove();

            }
            // dropshots validation page open in step-7

        } else {
            console.log('step-7 ka document ready hua hai');
            var $active = $('.nav-tabs li>.active');
            $active.parent().next().find('.nav-link').removeClass('disabled');
            nextTab($active);
        }
    });
    // step-7 ajax with validation page close

    // step-8 ajax with validation page open
    $(".next-step8").click(function(e) {
        console.log('project_wizzard js me hai step 8');
        if ($.trim($('#mediafire_url_id').val()) == '' || $.trim($('#slideshare_url_id').val()) == '' ||
            $.trim($('#scribd_url_id').val()) == '' || $.trim($('#4shared_url_id').val()) == '' ||
            $.trim($('#issuu_url_id').val()) == '') {
            var focusSet = false;

            // mediafire pgae validation open in step-8
            if (!$('#mediafire_url_id').val()) {
                if ($("#mediafire_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_mediafire").html("Please fill mediafire url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#mediafire_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#mediafire_url_id").parent().next(".validation").remove();
                // remove it
            }

            // mediafire pgae validation close in step-8

            // dailymotion blog validation page open in step-8
            if (!$('#slideshare_url_id').val()) {
                if ($("#slideshare_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_slideshare").html("Please fill errNm_slideshare url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#slideshare_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#slideshare_url_id").parent().next(".validation").remove();
                // remove it
            }
            // slideshare validation page close in step-8

            // scribd validation page open in step-8
            if (!$('#scribd_url_id').val()) {
                if ($("#scribd_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_scribd").html("Please fill scribd site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#scribd_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#scribd_url_id").parent().next(".validation").remove();

            }
            // scribd url id.com blog validation page open in step-8

            // 4shared validation page open in step-8
            if (!$('#4shared_url_id').val()) {
                if ($("#4shared_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_4shared").html("Please fill 4shared site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#4shared_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#4shared_url_id").parent().next(".validation").remove();

            }
            // 4shared_url_id blog validation page open in step-8

            // issuu  validation page open in step-8
            if (!$('#issuu_url_id').val()) {
                if ($("#issuu_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_issuu").html("Please fill issuu site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#issuu_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#issuu_url_id").parent().next(".validation").remove();

            }
            // issuu validation page open in step-8

        } else {
            console.log('example4 ka document ready hua hai');
            var $active = $('.nav-tabs li>.active');
            $active.parent().next().find('.nav-link').removeClass('disabled');
            nextTab($active);
        }
    });
    // step-8 ajax with validation page close

    // step-9 ajax with validation page open
    $(".next-step9").click(function(e) {
        console.log('Directory Submission Sites me hai step 9');
        if ($.trim($('#freeadstime_url_id').val()) == '' || $.trim($('#superadpost_url_id').val()) == '' || $.trim($('#findermaster_url_id').val()) == '' || $.trim($('#mastermoz_url_id').val()) == '' || $.trim($('#h1ad_url_id').val()) == '') {
            var focusSet = false;

            // freeadstime pgae validation open in step-9
            if (!$('#freeadstime_url_id').val()) {
                if ($("#freeadstime_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_freeadstime").html("Please fill freeadstime url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#freeadstime_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#freeadstime_url_id").parent().next(".validation").remove();
                // remove it
            }

            // freeadstime pgae validation close in step-9

            // superadpost blog validation page open in step-9
            if (!$('#superadpost_url_id').val()) {
                if ($("#superadpost_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_superadpost").html("Please fill superadpost url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#superadpost_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#superadpost_url_id").parent().next(".validation").remove();
                // remove it
            }
            // superadpost validation page close in step-9

            // findermaster validation page open in step-9
            if (!$('#findermaster_url_id').val()) {
                if ($("#findermaster_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_findermaster").html("Please fill findermaster site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#findermaster_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#findermaster_url_id").parent().next(".validation").remove();

            }
            // findermaster validation page open in step-9

            // mastermoz validation page open in step-9
            if (!$('#mastermoz_url_id').val()) {
                if ($("#mastermoz_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_mastermoz").html("Please fill mastermoz site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#mastermoz_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#mastermoz_url_id").parent().next(".validation").remove();

            }
            // mastermoz validation page open in step-9

            // h1ad  validation page open in step-9
            if (!$('#h1ad_url_id').val()) {
                if ($("#h1ad_url_id").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#errNm_h1ad").html("Please fill h1ad site url");
                }
                e.preventDefault(); // prevent form from POST to server
                $('#h1ad_url_id').focus();
                focusSet = true;
            } else {
                focusSet = false;
                $("#h1ad_url_id").parent().next(".validation").remove();

            }
            // h1ad validation page open in step-9

        } else {
            console.log('example4 ka document ready hua hai');
            var $active = $('.nav-tabs li>.active');
            $active.parent().next().find('.nav-link').removeClass('disabled');
            nextTab($active);
        }
    });
    // step-9 ajax with validation page close

    $(".prev-step").click(function(e) {

        $('#errNm10').hide();
        var $active = $('.nav-tabs li>a.active');
        prevTab($active);
    });

    function nextTab(elem) {
        $(elem).parent().next().find('a[data-toggle="tab"]').click();
    }

    function prevTab(elem) {
        $(elem).parent().prev().find('a[data-toggle="tab"]').click();
    }
    $('#create_project_wizard').click(function() {
        $('#create_project_wizard_modal').modal('show');
        $('#stepA').addClass('active');
        $('#stepB').addClass('disabled');
        $('#stepC').addClass('disabled');
        $('#stepD').addClass('disabled');
        $('#stepE').addClass('disabled');
        $('#stepF').addClass('disabled');
        $('#stepG').addClass('disabled');
        $('#stepH').addClass('disabled');
        $('#stepI').addClass('disabled');
        $('#stepJ').addClass('disabled');
        // $('#stepE').addClass('disabled');
        $('#stepB').removeClass('active');
        $('#stepC').removeClass('active');
        $('#stepD').removeClass('active');
        $('#stepE').removeClass('active');
        $('#stepF').removeClass('active');
        $('#stepG').removeClass('active');
        $('#stepH').removeClass('active');
        $('#stepI').removeClass('active');
        $('#stepJ').removeClass('active');
        // $('#stepE').removeClass('active');
        $('#step2').removeClass('active');
        $('#step3').removeClass('active');
        $('#step4').removeClass('active');
        $('#step5').removeClass('active');
        $('#step6').removeClass('active');
        $('#step7').removeClass('active');
        $('#step8').removeClass('active');
        $('#step9').removeClass('active');
        $('#step10').removeClass('active');
        $('#complete').removeClass('active');
        $('#step1').addClass('active');
        // $('#tumblr_url_id').val(null).trigger('change');
        // if ($('#plurk_url_id').val() != 'default') {
        //     $('#plurk_url_id option:selected').remove();
        // }

        // $('#trainer_class_name_form').show();

        $('#my_class_form')[0].reset();

        $('#form_result').html('');

        //#####################   After validation input and again add click button error will be hide open #############
        $('#errNm1').html('');
        $('#class_err').html('');
        $('.next-step1').removeAttr('');
        $('#fb_url_error').html('');
        $('#errNm_linkedIn').html('');
        $('#linkedIn_url_validate_error').html('');
        $('#twitter_url_validate_error').html('');
        $('#instagram_url_validate_error').html('');
        $('#youtube_url_validate_error').html('');
        $('.next-step2').removeAttr('');
        $('#reddit_url_validate_error').html('');
        $('#tumblr_url_validate_error').html('');
        $('#plurk_url_validate_error').html('');
        $('#getpocket_url_validate_error').html('');
        $('.next-step3').removeAttr('');
        $('#wix_url_validate_error').html('');
        $('#wordpress_url_validate_error').html('');
        $('#weebly_url_validate_error').html('');
        $('#medium_url_validate_error').html('');
        $('#professnow_url_validate_error').html('');
        $('.next-step4').removeAttr('');
        $('#github_url_validate_error').html('');
        $('#hubpages_url_validate_error').html('');
        $('#ehow_url_validate_error').html('');
        $('#dzone_url_validate_error').html('');

        $('#errNm3').html('');
        $('#errNm4').html('');
        $('#errNm5').html('');
        $('#errNm6').html('');
        $('#errRediit_url').html('');
        $('#errNm7').html('');
        $('#errNm8').html('');
        $('#errNm9').html('');
        $('#errNm10').html('');
        $('#errNm_wordpress').html('');
        $('#errNm_weebly').html('');
        $('#errNm_medium').html('');
        $('#errNm_professnow').html('');
        $('#errNm_github').html('');
        $('#errNm_hubpages').html('');
        $('#errNm_ehow_step_4').html('');
        $('#errNm_dzone').html('');
        $('#errNm_articlesfactory').html('');
        $('#errNm_justdial').html('');
        $('#errNm_sulekha').html('');
        $('#errNm_indiamart').html('');
        $('#errNm_quikr').html('');
        $('#errNm_click').html('');
        $('#errNm_quora').html('');
        $('#errNm_wikibooks').html('');
        $('#errNm_answers').html('');
        $('#errNm_superuser').html('');
        $('#errNm_dailymotion').html('');
        $('#errNm_vimeo').html('');
        $('#errNm_metacafe').html('');
        $('#errNm_dropshots').html('');
        $('#errNm_mediafire').html('');
        $('#errNm_slideshare').html('');
        $('#errNm_scribd').html('');
        $('#errNm_4shared').html('');
        $('#errNm_issuu').html('');
        $('#errNm_freeadstime').html('');
        $('#errNm_superadpost').html('');
        $('#errNm_findermaster').html('');
        $('#errNm_mastermoz').html('');
        $('#errNm_h1ad').html('');
        $('#errNm_imgur').html('');
        $('#err_flickr').html('');
        // $('#facebook_form').show(); from here skip button and input will be empty
        $('#facebook_form').show();
        $('#facebook_url_id').val('');
        $('#linkedIn_form').show();
        $('#linkedIn_url_id').val('');
        $('#twitter_url_id_form').show();
        $('#twitter_url_id').val('');
        $('#instagram_url_id_form').show();
        $('#instagram_url_id').val('');
        $('#youtube_url_id_form').show();
        $('#youtube_url_id').val('');
        $('#pinterest_url_id_form').show();
        $('#pinterest_url_id').val('');
        $('#reddit_form').show();
        $('#reddit_url_id').val('');
        $('#tumblr_url_id_form').show();
        $('#tumblr_url_id').val('');
        $('#plurk_url_id_form').show();
        $('#plurk_url_id').val('');
        $('#getpocket_url_id_form').show();
        $('#getpocket_url_id').val('');
        $('#wix_blog_form').show();
        $('#wix_url_id').val('');
        $('#wordpress_blog_form').show();
        $('#wordpress_url_id').val('');
        $('#weebly_blog_form').show();
        $('#weebly_url_id').val('');
        $('#medium_blog_form').show();
        $('#medium_url_id').val('');
        $('#professnow_blog_form').show();
        $('#professnow_url_id').val('');
        $('#github_blog_form').show();
        $('#github_url_id').val('');
        $('#hubpages_blog_form').show();
        $('#hubpages_url_id').val(''); // add wale funciton pe
        $('#ehow_blog_form').show();
        $('#ehow_url_id').val('');
        $('#dzone_blog_form').show();
        $('#dzone_url_id').val('');
        $('#articlesfactory_blog_form').show();
        $('#articlesfactory_url_id').val('');
        $('#justdial_blog_form').show();
        $('#justdial_url_id').val('');
        $('#sulekha_blog_form').show();
        $('#sulekha_url_id').val('');
        $('#indiamart_blog_form').show();
        $('#indiamart_url_id').val('');
        $('#quikr_blog_form').show();
        $('#quikr_url_id').val('');
        $('#click_blog_form').show();
        $('#click_url_id').val('');
        $('#quora_blog_form').show();
        $('#quora_url_id').val('');
        $('#wikibooks_blog_form').show();
        $('#wikibooks_url_id').val('');
        $('#answers_blog_form').show();
        $('#answers_url_id').val('');
        $('#superuser_blog_form').show();
        $('#superuser_url_id').val('');
        $('#dailymotion_blog_form').show();
        $('#dailymotion_url_id').val('');
        $('#vimeo_blog_form').show();
        $('#vimeo_url_id').val('');
        $('#metacafe_blog_form').show();
        $('#metacafe_url_id').val('');
        $('#dropshots_blog_form').show();
        $('#dropshots_url_id').val('');
        $('#mediafire_form').show();
        $('#mediafire_url_id').val('');
        $('#slideshare_form').show();
        $('#slideshare_url_id').val('');
        $('#scribd_blog_form').show();
        $('#scribd_url_id').val('');
        $('#4shared_blog_form').show();
        $('#4shared_url_id').val('');
        $('#issuu_form').show();
        $('#issuu_url_id').val('');
        $('#freeadstime_form').show();
        $('#freeadstime_url_id').val('');
        $('#superadpost_form').show();
        $('#superadpost_url_id').val('');
        $('#findermaster_blog_form').show();
        $('#findermaster_url_id').val('');
        $('#mastermoz_blog_form').show();
        $('#mastermoz_url_id').val('');
        $('#h1ad_form').show();
        $('#h1ad_url_id').val('');
        $('#imgur_form').show();
        $('#imgur_url_id').val('');
        $('#flickr_form').show();
        $('#flickr_url_id').val('');
        //######  After validation input and agin add click button error will be hide close #############

        $('.modal-title').text("Add wizards");
        // $('#create_project_wizard_modal').modal('show');
        $('#trainer_class_action_button').val("Add");
        $('#trainer_class_action').val("Add");
    });

    $('#my_class_form').on('submit', function(event) {
        event.preventDefault();

        if ($('#trainer_class_action').val() == 'Add') {
            console.log("my class Submit button pe click ho raha hai");
            if ($.trim($('#flickr_url_id').val()) == '' || $.trim($('#imgur_url_id').val()) == '') {
                var focusSet = false;

                // flickr validation page open in step-10
                if (!$('#flickr_url_id').val()) {
                    if ($("#flickr_url_id").parent().next(".validation").length == 0) // only add if not added
                    {
                        $("#err_flickr").html("Please fill flickr url");
                    }
                    // e.preventDefault(); // prevent form from POST to server
                    $('#flickr_url_id').focus();
                    focusSet = true;
                } else {
                    focusSet = false;
                    $("#flickr_url_id").parent().next(".validation").remove();

                }
                // flickr validation page open in step-10

                if (!$('#imgur_url_id').val()) {
                    if ($("#imgur_url_id").parent().next(".validation").length == 0) // only add if not added
                    {
                        $("#errNm_imgur").html("Please fill imgur  url");
                    }
                    // e.preventDefault(); // prevent form from POST to server
                    $('#imgur_url_id').focus();
                    focusSet = true;
                } else {
                    $("#imgur_url_id").parent().next(".validation").remove(); // remove it
                }

            } else {

                $.ajax({
                    url: '/api/v1/j/wizard/store_wizards',
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    success: function(data) {
                        console.log('abhi ham success function ke ander aaye hai');
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message + '</div>';
                            $('#form_result').html(html);
                            setTimeout(function() {
                                $('#create_project_wizard_modal').modal('hide');
                                $('#my_class_form')[0].reset();
                                $('#wizardmodel').modal('show');
                                $('#wizardTable').DataTable().ajax.reload();
                                $('#create_project_wizard_modal')[0].reset();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
                    },
                    complete: function complete(data) {
                        $('#errNm11').hide();
                    },
                    error: function error(data) {
                        console.log('Error:', data);
                    }
                });
            }
        }
        if ($('#trainer_class_action_button').val() == "Update") {
            console.log("update pe click ho rha hai");
            $.ajax({
                "url": '/api/v1/j/wizard/update_wizard',
                "type": "POST",
                "data": new FormData(this),
                "contentType": false,
                "cache": false,
                "processData": false,
                "dataType": "json",
                "headers": {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function success(data) {
                    $('#input_id').hide();
                    $('#create_project_wizard_modal').modal('hide');
                    $('#my_class_form')[0].reset();
                    $('#wizardTable').DataTable().ajax.reload();
                    $('#myclassupdatemodel').modal('show');
                },
                error: function error(data) {
                    console.log('Error:', data);
                }
            });
        }
    });


    $(document).on('click', '.editWizardBtn', function() {
        console.log('working edit button wizbrandbtn');
        $('#errNm1').hide();
        $('#errNm_linkedIn').hide();
        $('#errNm3').hide();
        $('#errNm4').hide();
        $('#errNm5').hide();
        $('#errNm6').hide();
        $('#errRediit_url').hide();
        $('#errNm7').hide();
        $('#errNm8').hide();
        $('#errNm9').hide();
        $('#errNm10').hide();
        $('#errNm_wordpress').hide();
        $('#errdmv').hide();
        $('#errcrsd').hide();

        // $('#trainer_class_name_form').show();
        $('trainer_class_agenda').html('');
        $('#stepA').addClass('active');
        $('#stepB').addClass('disabled');
        $('#stepC').addClass('disabled');
        $('#stepD').addClass('disabled');
        $('#stepF').addClass('disabled');
        $('#stepE').addClass('disabled');
        //
        $('#stepF').addClass('disabled');
        $('#stepG').addClass('disabled');
        $('#stepH').addClass('disabled');
        $('#stepI').addClass('disabled');
        $('#stepJ').addClass('disabled');
        //
        $('#stepB').removeClass('active');
        $('#stepC').removeClass('active');
        $('#stepD').removeClass('active');
        $('#stepE').removeClass('active');
        $('#stepF').removeClass('active');
        $('#stepG').removeClass('active');
        $('#stepH').removeClass('active');
        $('#stepI').removeClass('active');
        $('#stepJ').removeClass('active');
        $('#step2').removeClass('active');
        $('#step3').removeClass('active');
        $('#step4').removeClass('active');
        $('#step5').removeClass('active');
        $('#step6').removeClass('active');
        $('#step7').removeClass('active');
        $('#step8').removeClass('active');
        $('#step9').removeClass('active');
        // edit krte time yah pe douat hai
        $('#step10').removeClass('active');
        //
        // $('#stepB').removeClass('active');
        // $('#stepC').removeClass('active');
        // $('#stepD').removeClass('active');
        // $('#stepE').removeClass('active');
        // $('#stepF').removeClass('active');
        // $('#stepJ').removeClass('active');
        // $('#step2').removeClass('active');
        // $('#step3').removeClass('active');
        // $('#step4').removeClass('active');
        // $('#step4a').removeClass('active');
        $('#complete').removeClass('active');
        $('#step1').addClass('active');
        $('#tumblr_url_id option:selected').remove();

        //#####################    input and edit button click button error will be hide open #############
        $('#errNm1').html('');
        $('#class_err').html('');
        $('#errNm_linkedIn').html('');
        $('#errNm3').html('');
        $('#errNm4').html('');
        $('#errNm5').html('');
        $('#errNm6').html('');
        $('#errRediit_url').html('');
        $('#errNm7').html('');
        $('#errNm8').html('');
        $('#errNm9').html('');
        $('#errNm10').html('');
        $('#errNm_wordpress').html('');
        $('#errNm_weebly').html('');
        $('#errNm_medium').html('');
        $('#errNm_professnow').html('');
        $('#errNm_github').html('');
        $('#errNm_hubpages').html('');
        $('#errNm_ehow_step_4').html('');
        $('#errNm_dzone').html('');
        $('#errNm_articlesfactory').html('');
        $('#errNm_justdial').html('');
        $('#errNm_sulekha').html('');
        $('#errNm_indiamart').html('');
        $('#errNm_quikr').html('');
        $('#errNm_click').html('');
        $('#errNm_quora').html('');
        $('#errNm_wikibooks').html('');
        $('#errNm_answers').html('');
        $('#errNm_superuser').html('');
        $('#errNm_dailymotion').html('');
        $('#errNm_vimeo').html('');
        $('#errNm_metacafe').html('');
        $('#errNm_dropshots').html('');
        $('#errNm_mediafire').html('');
        $('#errNm_slideshare').html('');
        $('#errNm_scribd').html('');
        $('#errNm_4shared').html('');
        $('#errNm_issuu').html('');
        $('#errNm_freeadstime').html('');
        $('#errNm_superadpost').html('');
        $('#errNm_findermaster').html('');
        $('#errNm_mastermoz').html('');
        $('#errNm_h1ad').html('');
        $('#errNm_imgur').html('');
        $('#err_flickr').html('');
        // $('#facebook_form').show(); from here skip button and input will be empty
        $('#facebook_form').show();
        $('#facebook_url_id').val('');
        $('#linkedIn_form').show();
        $('#linkedIn_url_id').val('');
        $('#twitter_url_id_form').show();
        $('#twitter_url_id').val('');
        $('#instagram_url_id_form').show();
        $('#instagram_url_id').val('');
        $('#youtube_url_id_form').show();
        $('#youtube_url_id').val('');
        $('#pinterest_url_id_form').show();
        $('#pinterest_url_id').val('');
        $('#reddit_form').show();
        $('#reddit_url_id').val('');
        $('#tumblr_url_id_form').show();
        $('#tumblr_url_id').val('');
        $('#plurk_url_id_form').show();
        $('#plurk_url_id').val('');
        $('#getpocket_url_id_form').show();
        $('#getpocket_url_id').val('');
        $('#wix_blog_form').show();
        $('#wix_url_id').val('');
        $('#wordpress_blog_form').show();
        $('#wordpress_url_id').val('');
        $('#weebly_blog_form').show();
        $('#weebly_url_id').val('');
        $('#medium_blog_form').show();
        $('#medium_url_id').val('');
        $('#professnow_blog_form').show();
        $('#professnow_url_id').val('');
        $('#github_blog_form').show();
        $('#github_url_id').val('');
        $('#hubpages_blog_form').show();
        $('#hubpages_url_id').val(''); // edit wale function pe
        $('#ehow_blog_form').show();
        $('#ehow_url_id').val('');
        $('#dzone_blog_form').show();
        $('#dzone_url_id').val('');
        $('#articlesfactory_blog_form').show();
        $('#articlesfactory_url_id').val('');
        $('#justdial_blog_form').show();
        $('#justdial_url_id').val('');
        $('#sulekha_blog_form').show();
        $('#sulekha_url_id').val('');
        $('#indiamart_blog_form').show();
        $('#indiamart_url_id').val('');
        $('#quikr_blog_form').show();
        $('#quikr_url_id').val('');
        $('#click_blog_form').show();
        $('#click_url_id').val('');
        $('#quora_blog_form').show();
        $('#quora_url_id').val('');
        $('#wikibooks_blog_form').show();
        $('#wikibooks_url_id').val('');
        $('#answers_blog_form').show();
        $('#answers_url_id').val('');
        $('#superuser_blog_form').show();
        $('#superuser_url_id').val('');
        $('#dailymotion_blog_form').show();
        $('#dailymotion_url_id').val('');
        $('#vimeo_blog_form').show();
        $('#vimeo_url_id').val('');
        $('#metacafe_blog_form').show();
        $('#metacafe_url_id').val('');
        $('#dropshots_blog_form').show();
        $('#dropshots_url_id').val('');
        $('#mediafire_form').show();
        $('#mediafire_url_id').val('');
        $('#slideshare_form').show();
        $('#slideshare_url_id').val('');
        $('#scribd_blog_form').show();
        $('#scribd_url_id').val('');
        $('#4shared_blog_form').show();
        $('#4shared_url_id').val('');
        $('#issuu_form').show();
        $('#issuu_url_id').val('');
        $('#freeadstime_form').show();
        $('#freeadstime_url_id').val('');
        $('#superadpost_form').show();
        $('#superadpost_url_id').val('');
        $('#findermaster_blog_form').show();
        $('#findermaster_url_id').val('');
        $('#mastermoz_blog_form').show();
        $('#mastermoz_url_id').val('');
        $('#h1ad_form').show();
        $('#h1ad_url_id').val('');
        $('#imgur_form').show();
        $('#imgur_url_id').val('');
        $('#flickr_form').show();
        $('#flickr_url_id').val('');
        //######################  After validation input and agin edit button pe click button error will be hide close #############
        var id = $(this).attr('id');
        console.log("ecit functoin is working " + id);
        $('#trainer_class_form_result').html('');
        $('#form_result').html('');
        $.ajax({
            "type": "get",
            "data": {},
            "url": '/api/v1/j/wizard/edit_wizard/' + id,
            "headers": {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },

            beforeSend: function beforeSend() {
                console.log("inside before");

                if ($('#project_name').val() != '') {
                    $('#errNm1').hide();
                }
                if ($('#facebook_url_id').val() != '') {
                    $('#class_err').hide();
                }
                if ($('#reddit_url_id').val() != '') {
                    $('#errRediit_url').hide();
                }
                $("#linkedIn_url_id");
                if ($('#linkedIn_url_id').val() != '') {
                    $('#errNm_linkedIn').hide();
                }
                $("#twitter_url_id");
                if ($('#twitter_url_id').val() != '') {
                    $('#errNm3').hide();
                }
                if ($('#instagram_url_id').val() != '') {
                    $('#errNm4').hide();
                }
                if ($('#youtube_url_id').val() != '') {
                    $('#errNm5').hide();
                }


            },
            success: function success(html) {
                console.log(html);
                $('#project_name').val(html.data.project_name);
                $('#facebook_url_id').val(html.data.facebook);
                $('#linkedIn_url_id').val(html.data.linkedIn);
                $('#twitter_url_id').val(html.data.twitter);
                $('#reddit_url_id').val(html.data.reddit);
                $('#youtube_url_id').val(html.data.youtube);
                $('#tumblr_url_id').val(html.data.tumblr);
                $('#plurk_url_id').val(html.data.plurk);
                $('#getpocket_url_id').val(html.data.getpocket);
                $('#wix_url_id').val(html.data.wix);
                $('#wordpress_url_id').val(html.data.wordpress);
                $('#weebly_url_id').val(html.data.weebly);
                $('#medium_url_id').val(html.data.medium);
                $('#professnow_url_id').val(html.data.professnow);
                $('#github_url_id').val(html.data.github);
                $('#hubpages_url_id').val(html.data.hubpages);
                console.log("hubpages ka value aa rha hai");
                $('#ehow_url_id').val(html.data.ehow);
                $('#dzone_url_id').val(html.data.dzone);
                $('#articlesfactory_url_id').val(html.data.articlesfactory);
                $('#justdial_url_id').val(html.data.justdial);
                $('#sulekha_url_id').val(html.data.sulekha);
                $('#indiamart_url_id').val(html.data.indiamart);
                $('#quikr_url_id').val(html.data.quikr);
                $('#click_url_id').val(html.data.click);
                $('#quora_url_id').val(html.data.quora);
                $('#wikibooks_url_id').val(html.data.wikibooks);
                $('#answers_url_id').val(html.data.answers);
                $('#superuser_url_id').val(html.data.superuser);
                $('#dailymotion_url_id').val(html.data.dailymotion);
                $('#vimeo_url_id').val(html.data.vimeo);
                $('#metacafe_url_id').val(html.data.metacafe);
                $('#dropshots_url_id').val(html.data.dropshots);
                $('#mediafire_url_id').val(html.data.mediafire);
                $('#slideshare_url_id').val(html.data.slideshare);
                $('#scribd_url_id').val(html.data.scribd);
                $('#4shared_url_id').val(html.data.four_shared);
                $('#issuu_url_id').val(html.data.issuu);
                $('#freeadstime_url_id').val(html.data.freeadstime);
                $('#superadpost_url_id').val(html.data.superadpost);
                $('#findermaster_url_id').val(html.data.findermaster);
                $('#mastermoz_url_id').val(html.data.mastermoz);
                $('#h1ad_url_id').val(html.data.h1ad);
                $('#imgur_url_id').val(html.data.imgur);
                $('#flickr_url_id').val(html.data.flickr);
                $('#instagram_url_id').val(html.data.instagram);
                $('#pinterest_url_id').val(html.data.pinterest);
                $('#trainer_class_agenda').html(html.data.agenda);
                $('.modal-title').text("Edit Wizard");
                $('#trainer_class_action_button').val("Update");
                // $('#trainer_class_action').val("Update");
                $('#create_project_wizard_modal').modal('show');
                $('#wizard_Hidden_id').val(id);
                console.log("ecit functoin is working step-2 " + id);
            }
        });
    });

    // ##############################################  view all url in modal open  ########################################
    $(document).on('click', '.viewAllValueModalLong', function() {
        console.log('working view button wizbrandbtn step-view button viewAllValueModalLong');

        var id = $(this).attr('id');
        console.log(" viewmodal open on viewclick " + id);
        $('#trainer_class_form_result').html('');
        $('#form_result').html('');
        $.ajax({
            "type": "get",
            "data": {},
            "url": '/api/v1/j/wizard/edit_wizard/' + id,
            "headers": {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function success(html) {
                var project_view_title = html.data.project_name;
                var facebook_view_title = html.data.facebook;
                var linkedIn_view_title = html.data.linkedIn;
                var twitter_view_title = html.data.twitter;
                var reddit_view_title = html.data.reddit;
                var youtube_view_title = html.data.youtube;
                var tumblr_view_title = html.data.tumblr;
                var plurk_view_title = html.data.plurk;
                var getpocket_view_title = html.data.getpocket;
                var wix_view_title = html.data.wix;
                var wordpress_view_title = html.data.wordpress;
                var weebly_view_title = html.data.weebly;
                var medium_view_title = html.data.medium;
                var professnow_view_title = html.data.professnow;
                var github_view_title = html.data.github;
                var hubpages_view_titles = html.data.hubpages;
                var ehow_view_title = html.data.ehow;
                var dzone_view_title = html.data.dzone;
                var articlesfactory_view_title = html.data.articlesfactory;
                var justdial_view_title = html.data.justdial;
                var sulekha_view_title = html.data.sulekha;
                var indiamart_view_title = html.data.indiamart;
                var quikr_view_title = html.data.quikr;
                var click_view_title = html.data.click;
                var quora_view_title = html.data.quora;
                var wikibooks_view_title = html.data.wikibooks;
                var answers_view_title = html.data.answers;
                var superuser_view_title = html.data.superuser;
                var dailymotion_view_title = html.data.dailymotion;
                var vimeo_view_title = html.data.vimeo;
                var metacafe_view_title = html.data.metacafe;
                var dropshots_view_title = html.data.dropshots;
                var mediafirets_view_title = html.data.mediafirets;
                var slideshare_view_title = html.data.slideshare;
                var scribd_view_title = html.data.scribd;
                var four_shared_view_title = html.data.four_shared;
                var issuu_view_title = html.data.issuu;
                var freeadstime_view_title = html.data.freeadstime;
                var superadpost_view_title = html.data.superadpost;
                var findermaster_view_title = html.data.findermaster;
                var mastermoz_view_title = html.data.mastermoz;
                var h1ad_view_title = html.data.h1ad;
                var imgur_view_title = html.data.imgur;
                var flickr_view_title = html.data.flickr;
                var instagram_view_title = html.data.instagram;
                var pinterest_view_title = html.data.pinterest;

                //    fb skip if condition open
                if (html.data.facebook != 'skiped') {
                    $('#facebook_view').html(facebook_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#facebook_view').html('skiped url of facebook').css('color', 'red');

                    console.log('now we are in else condition');
                }
                //    fb skip if condition close

                //    linkedin start

                if (html.data.linkedIn != 'skiped') {
                    $('#linkedin_view').html(linkedIn_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#linkedin_view').html('skiped url of linkedIn').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    linkedin end

                //    twitter start
                if (html.data.twitter != 'skiped') {
                    $('#twitter_name_view').html(twitter_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#twitter_name_view').html('skiped url of Twitter').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    twitter end
                //    reddit start
                if (html.data.reddit != 'skiped') {
                    $('#reddit_name_view').html(reddit_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#reddit_name_view').html('skiped url of reddit').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    reddit end
                //    youtube start
                if (html.data.youtube != 'skiped') {
                    $('#youtube_name_view').html(youtube_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#youtube_name_view').html('skiped url of youtube').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    youtube end

                //    tumblr start
                if (html.data.tumblr != 'skiped') {
                    $('#tumblr_name_view').html(tumblr_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#tumblr_name_view').html('skiped url of tumblr').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    tumblr end

                //    plurk start

                if (html.data.plurk != 'skiped') {
                    $('#plurk_name_view').html(plurk_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#plurk_name_view').html('skiped url of plurk').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    getpocket start
                if (html.data.getpocket != 'skiped') {
                    $('#getpocket_name_view').html(getpocket_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#getpocket_name_view').html('skiped url of getpocket').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    getpocket end
                //    wix start
                if (html.data.wix != 'skiped') {
                    $('#wix_name_view').html(wix_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#wix_name_view').html('skiped url of wix').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    wix end
                //    wix start
                if (html.data.wix != 'skiped') {
                    $('#wix_name_view').html(wix_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#wix_name_view').html('skiped url of wix').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    wix end

                //    wordpress start
                if (html.data.wordpress != 'skiped') {
                    $('#wordpress_name_view').html(wordpress_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#wordpress_name_view').html('skiped url of wordpress').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    wordpress end
                //    weebly start
                if (html.data.weebly != 'skiped') {
                    $('#weebly_name_view').html(weebly_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#weebly_name_view').html('skiped url of weebly').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    weebly end

                //    medium start
                if (html.data.medium != 'skiped') {
                    $('#medium_name_view').html(medium_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#medium_name_view').html('skiped url of medium').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    medium end
                //    professnow start
                if (html.data.professnow != 'skiped') {
                    $('#professnow_name_view').html(professnow_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#professnow_name_view').html('skiped url of professnow').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    professnow end
                //    github start
                if (html.data.github != 'skiped') {
                    $('#professnow_name_view').html(github_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#professnow_name_view').html('skiped url of github').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    github end
                //    hubpages start
                if (html.data.hubpages != 'skiped') {
                    $('#hubpages_name_view').html(hubpages_view_titles);
                    console.log('now we are in if condition');
                } else {
                    $('#hubpages_name_view').html('skiped url of hubpages').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    hubpages end
                //    ehow start
                if (html.data.ehow != 'skiped') {
                    $('#ehow_name_view').html(ehow_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#ehow_name_view').html('skiped url of ehow').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    ehow end
                //    dzone start
                if (html.data.dzone != 'skiped') {
                    $('#dzone_name_view').html(dzone_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#dzone_name_view').html('skiped url of dzone').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    dzone end
                //    articlesfactory start
                if (html.data.articlesfactory != 'skiped') {
                    $('#articlesfactory_name_view').html(articlesfactory_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#articlesfactory_name_view').html('skiped url of articlesfactory').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    articlesfactory end
                //    justdial start
                if (html.data.justdial != 'skiped') {
                    $('#justdial_name_view').html(justdial_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#justdial_name_view').html('skiped url of justdial').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    justdial end
                //    sulekha start
                if (html.data.sulekha != 'skiped') {
                    $('#sulekha_name_view_url').html(sulekha_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#sulekha_name_view_url').html('skiped url of sulekha').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    sulekha end
                //    indiamart start
                if (html.data.indiamart != 'skiped') {
                    $('#indiamart_name_view').html(indiamart_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#indiamart_name_view').html('skiped url of indiamart').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    indiamart end
                //    quikr start
                if (html.data.quikr != 'skiped') {
                    $('#quikr_name_view_url').html(quikr_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#quikr_name_view_url').html('skiped url of quikr').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    quikr end
                //    click start
                if (html.data.click != 'skiped') {
                    $('#click_name_view').html(click_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#click_name_view').html('skiped url of click').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    click end
                //    click start
                if (html.data.quora != 'skiped') {
                    $('#quora_name_view').html(quora_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#quora_name_view').html('skiped url of click').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    click end
                //    wikibooks start
                if (html.data.wikibooks != 'skiped') {
                    $('#wikibooks_name_view').html(wikibooks_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#wikibooks_name_view').html('skiped url of wikibooks').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    wikibooks end
                //    answers start
                if (html.data.answers != 'skiped') {
                    $('#answers_name_view').html(answers_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#answers_name_view').html('skiped url of answers').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    answers end
                //    superusers start
                if (html.data.superuser != 'skiped') {
                    $('#superuser_name_view').html(superuser_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#superuser_name_view').html('skiped url of superusers').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    superusers end
                //    dailymotion start
                if (html.data.dailymotion != 'skiped') {
                    $('#dailymotion_name_view').html(dailymotion_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#dailymotion_name_view').html('skiped url of dailymotion').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    dailymotion end
                //    vimeo start
                if (html.data.vimeo != 'skiped') {
                    $('#vimeo_name_view').html(vimeo_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#vimeo_name_view').html('skiped url of vimeo').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    vimeo end
                //    metacafe start
                if (html.data.metacafe != 'skiped') {
                    $('#metacafe_name_view').html(metacafe_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#metacafe_name_view').html('skiped url of metacafe').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    dropshots end
                if (html.data.dropshots != 'skiped') {
                    $('#dropshots_name_view').html(dropshots_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#dropshots_name_view').html('skiped url of dropshots').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    dropshots end
                //    mediafirets end
                if (html.data.mediafirets != 'skiped') {
                    $('#mediafire_name_view').html(mediafirets_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#mediafire_name_view').html('skiped url of mediafire').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    mediafirets end
                //    slideshares end
                if (html.data.slideshare != 'skiped') {
                    $('#slideshare_name_view').html(slideshare_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#slideshare_name_view').html('skiped url of slideshares').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    slideshares end
                //    scribd start
                if (html.data.scribd != 'skiped') {
                    $('#scribd_name_view').html(scribd_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#scribd_name_view').html('skiped url of scribd').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    scribd end
                //    four_shared start
                if (html.data.four_shared != 'skiped') {
                    $('#4shared_name_view').html(four_shared_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#4shared_name_view').html('skiped url of four shared').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    four_shared end
                //    issuu start
                if (html.data.issuu != 'skiped') {
                    $('#issuu_name_view').html(issuu_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#issuu_name_view').html('skiped url of issuu').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    issuu end
                //    freeadstime start
                if (html.data.freeadstime != 'skiped') {
                    $('#freeadstime_name_view').html(freeadstime_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#freeadstime_name_view').html('skiped url of freeadstime').css('color', 'red');
                    console.log('now we are in else condition');
                }

                // findermaster_name_view master start here

                if (html.data.findermaster != 'skiped') {
                    $('#findermaster_name_view').html(findermaster_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#findermaster_name_view').html('skiped url of findermaster').css('color', 'red');
                    console.log('now we are in else condition');
                }
                // finder master end here
                //    freeadstime end
                //    superadpost start
                if (html.data.superadpost != 'skiped') {
                    $('#superadpost_name_view').html(superadpost_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#superadpost_name_view').html('skiped url of superadpost').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    superadpost end

                //    mastermoz start
                if (html.data.mastermoz != 'skiped') {
                    $('#mastermoz_name_view').html(mastermoz_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#mastermoz_name_view').html('skiped url of mastermoz').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    mastermoz end
                //    h1ad start
                if (html.data.h1ad != 'skiped') {
                    $('#h1ad_name_view').html(h1ad_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#h1ad_name_view').html('skiped url of h1ad').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    h1ad end
                //    imgur start
                if (html.data.imgur != 'skiped') {
                    $('#imgur_name_view').html(imgur_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#imgur_name_view').html('skiped url of imgur').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    imgur end
                //    flickr start
                if (html.data.flickr != 'skiped') {
                    $('#flickr_name_view').html(flickr_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#flickr_name_view').html('skiped url of flickr').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    flickr end
                //    instagram start
                if (html.data.instagram != 'skiped') {
                    $('#instagram_name_view').html(instagram_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#instagram_name_view').html('skiped url of instagram').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    instagram end
                //    pinterest start
                if (html.data.pinterest != 'skiped') {
                    $('#pinterest_name_view').html(pinterest_view_title);
                    console.log('now we are in if condition');
                } else {
                    $('#pinterest_name_view').html('skiped url of pinterest').css('color', 'red');
                    console.log('now we are in else condition');
                }
                //    pinterest end
                $('#project_name_view').html(project_view_title);
                $('#trainer_class_agenda').html(html.data.agenda);
                $('.modal-title_view').text("view all url");
                $('#viewAllValueModal').modal('show');
                $('#wizard_Hidden_id').val(id);
                $('.wiz_confirm_delete_modals').text("wizard Delete");
                console.log("view miodal call ho rha hai " + id);
            }
        });
    });
    // #########################################  view all url in modal close  ##################################


    var user_id;
    $(document).on('click', '.deleteWizardProject', function() {
        user_id = $(this).attr('id');
        $('#wiz_confirm_delete_modals').modal('show');
    });

    $('#ok_button').click(function() {
        console.log('working delete button pe click ho rha  hai');
        $('#name_form').show();
        $('#form_result').html('');
        $.ajax({
            "type": "get",
            "data": {},
            "url": '/api/v1/j/wizard/destroy_wizard/' + user_id,
            "headers": {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            beforeSend: function beforeSend() {
                $('#ok_button').text('Deleting');
            },
            success: function success(data) {
                $('#wiz_confirm_delete_modals').modal('hide');
                $('#wizardTable').DataTable().ajax.reload();
                $('#ok_button').text('OK');

            },
            error: function error(data) {
                console.log('Error:', data);
            }
        });
    });
});
// website open modal start here 
// $(document).ready(function() {
//     $('#create_project_wizard_modal').modal('show');
//     $('#create_project_wizard').hide();
// });
// website open modal end here