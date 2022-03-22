$( document ).ready(function() {
   $("#hideThisFirst").hide();
});

$("#urlSumition").submit(function(e) {
    console.log('requesting aax');

   e.preventDefault(); // avoid to execute the actual submit of the form.
   var form = $(this);
   $.ajax({
       type: "POST",
       url: "/url_analyser",
       data: form.serialize(), // serializes the form's elements.
    //    beforeSend: function(data){
    //    },
       success: function(data)
       {
           console.log(data);
           console.log('success me aa rha hai')

              $("#renderFetchedData").append(
               '<li class="list-group-item">Number of Words on the page' +
               '<span class="float-right">'+data.Number_of_words+'</span></li>'+
               '<li class="list-group-item">Number of Characters on the page' +
               '<span class="float-right">'+data.Number_of_characters+'</span>'+
               '<li class="list-group-item">Number of Images on the page'+
               '<span class="float-right">'+data.Number_of_images+'</span>'+
               '<li class="list-group-item">Number of Internal Links on the page'+
               '<span class="float-right">'+data.Number_of_Internal_Urls+'</span>'+
               '<li class="list-group-item">Number of External Links on the page'+
               '<span class="float-right">'+data.Number_of_External_urls+'</span>'+
               '<li class="list-group-item">Number of Paragraph on the page'+
               '<span class="float-right">'+data.Number_of_paragraphs+'</span>'+
               '<li class="list-group-item">Number of Embeded Video on the page'+
               '<span class="float-right">'+data.Number_of_video+'</span>'+
               '<li class="list-group-item">Number of H1 on the page'+
               '<span class="float-right">'+data.Number_of_h1+'</span>'+
               '<li class="list-group-item">Number of H2 on the page'+
               '<span class="float-right">'+data.Number_of_h2+'</span>'+
               '<li class="list-group-item">Number of H3 on the page'+
               '<span class="float-right">'+data.Number_of_h3+'</span>'+
               '<li class="list-group-item">Number of H4 on the page'+
               '<span class="float-right">'+data.Number_of_h4+'</span>'+
               '<li class="list-group-item">Number of H5 on the page'+
               '<span class="float-right">'+data.Number_of_h5+'</span>'+
               '<li class="list-group-item">Number of H6 on the page'+
               '<span class="float-right">'+data.Number_of_h6+'</span>'+
               '<li class="list-group-item">Title of the page'+
               '<span class="float-right">'+data.Title_of_the_page+'</span>'+
               '<li class="list-group-item">Number of What found on page'+
               '<span class="float-right">'+data.Number_of_what_count+'</span>'+
               '<li class="list-group-item">Number of How found on page'+
               '<span class="float-right">'+data.Number_of_how_count+'</span>'+
               '<li class="list-group-item">Number of Why found on page'+
               '<span class="float-right">'+data.Number_of_why_count+'</span>'+
               '<li class="list-group-item">Number of When found on page'+
               '<span class="float-right">'+data.Number_of_when_count+'</span>'+
               '<li class="list-group-item">Number of Where found on page'+
               '<span class="float-right">'+data.Number_of_where_count+'</span>'
               );
               $("#hideThisFirst").show();
               $.each(data.Meta_key_words, function(key, value) {
                  $('#metaTable').append('<tr><td>'+key+'</td><td class="float-right">'+value+'</td></tr>');
              });
               $.each(data.List_of_images, function(key, value) {
                  $('#listOfImage').append('<li>'+value+'</li>');
              });
               $.each(data.List_of_Internal_Urls, function(key, value) {
                  $('#listOfExternalLinks').append('<li>'+value+'</li>');
              });
               $.each(data.List_of_External_urls, function(key, value) {
                  $('#listOfInternalLinks').append('<li>'+value+'</li>');
              });
              $("#resetSubmitButton").html('Reset');
       },
       error: function(response){
          console.log(response);
          console.log(response.status);
          console.log(response.responseJSON.Message);
         $("#showErrorMessage").addClass('h2').text(response.responseJSON.Message);
       }
   });

});

