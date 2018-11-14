$(document).ready(function(){
     $("#input").on('keyup', function() { // everytime keyup event
             var input = $(this).val(); // We take the input value
             if ( input.length >= 2 ) { // Minimum characters = 2 (you can change)
                     var data = {input: input}; // We pass input argument in Ajax

                     $.ajax({
                         type: "POST",
                             url: "http://blindeur.fr/web/app_dev.php/search", // call the php file ajax/tuto-autocomplete.php (check the routine we defined)
                             data: data, // Send dataFields var
                             dataType: 'json', // json method
                             timeout: 3000,
                             success: function(response){ // If success
                                     $('#match').html(response.produitList); // Return data (UL list) and insert it in the <div id="match"></div>
                                     $('#matchList li').on('click', function() { // When click on an element in the list>
                                       var form = document.createElement("form");
                                       form.setAttribute("method", "post");
                                       form.setAttribute("action", "/searchproduct");
                                       var hiddenField = document.createElement("input");
                                       hiddenField.setAttribute("type", "hidden");
                                       hiddenField.setAttribute("name", "produit");
                                       hiddenField.setAttribute("value", $(this).text());
                                       form.appendChild(hiddenField);
                                       document.body.appendChild(form);
                                       form.submit();
                                   });     
                                 },
                         });
} else {
                     $('#match').text(''); // If less than 2 characters, clear the <div id="match"></div>
                 }
             });
});