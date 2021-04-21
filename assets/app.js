/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

import $ from 'jquery';


// start the Stimulus application
import './bootstrap';



// Permet l'affichage du nom de l'image dans Create et Edit
$('.custom-file-input').on('change', function (e) {
    var inputFile = e.currentTarget;
    $(inputFile).parents().find('.custom-file-label').html(inputFile.files[0].name);
});
