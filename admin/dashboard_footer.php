
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="#" target="_blank">&copy; tsirtx <?php echo date('Y'); ?></a></p>
  </footer>

  <!-- End page content -->
</div>

<!----------- ---custom js------------------->
<!-- <script src="./js/custom.js"></script> -->

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
<!----------------dropdown js-------------->
<script src="./js/custom.js"></script>

<!-- tinymce script -->
<script src="https://cdn.tiny.cloud/1/smlmo7zguz5ckdbk916l75oqtw3cj46bibuui9y8rvm8ogb1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<!-- tinymce script classic -->
<script>
var table = '<p>This table uses features of the non-editable plugin to make the text in the<br /><strong>top row</strong> and <strong>left column</strong> uneditable.</p>' +
'    <table style="width: 60%; border-collapse: collapse;" border="1"> ' +
'        <caption class="mceNonEditable">Ephox Sales Analysis</caption> ' +
'       <tbody> ' +
'          <tr class="mceNonEditable"> ' +
'                <th style="width: 40%;">&nbsp;</th><th style="width: 15%;">Q1</th> ' +
'                <th style="width: 15%;">Q2</th><th style="width: 15%;">Q3</th> ' +
'                <th style="width: 15%;">Q4</th> ' +
'            </tr> ' +
'            <tr> ' +
'                <td class="mceNonEditable">East Region</td> ' +
'                <td>100</td> <td>110</td> <td>115</td> <td>130</td> ' +
'            </tr> ' +
'            <tr> ' +
'                <td class="mceNonEditable">Central Region</td> ' +
'                <td>100</td> <td>110</td> <td>115</td> <td>130</td> ' +
'            </tr> ' +
'            <tr> ' +
'                <td class="mceNonEditable">West Region</td> ' +
'                <td>100</td> <td>110</td> <td>115</td> <td>130</td> ' +
'            </tr> ' +
'        </tbody> ' +
'    </table>';

var table2 = '<div> ' +
'        <p>' +
'            Templates are a great way to help content authors get started creating content.  You can define the HTML for the template and ' +
'            then when the author inserts the template they have a great start towards creating content! ' +
'        </p> ' +
'        <p> ' +
'            In this example we create a simple table for providing product details for a product page on your web site.  The headings are ' +
'            made non-editable by loading the non-editable plugin and placing the correct class on the appropriate table cells. ' +
'        </p> ' +
'        <table style="width:90%; border-collapse: collapse;" border="1"> ' +
'        <tbody> ' +
'        <tr style="height: 30px;"> ' +
'            <th class="mceNonEditable" style="width:40%; text-align: left;">Product Name:</td><td style="width:60%;">{insert name here}</td> ' +
'        </tr> ' +
'        <tr style="height: 30px;"> ' +
'            <th class="mceNonEditable" style="width:40%; text-align: left;">Product Description:</td><td style="width:60%;">{insert description here}</td> ' +
'        </tr> ' +
'        <tr style="height: 30px;"> ' +
'            <th class="mceNonEditable" style="width:40%; text-align: left;">Product Price:</td><td style="width:60%;">{insert price here}</td> ' +
'        </tr> ' +
'        </tbody> ' +
'        </table> ' +
'    </div> ';

var demoBaseConfig = {
selector: "textarea#textarea",
width: 955,
height: 500,
resize: false,
autosave_ask_before_unload: false,
powerpaste_allow_local_images: true,
plugins: [
"a11ychecker advcode advlist anchor autolink codesample fullscreen help image imagetools tinydrive",
" lists link media noneditable powerpaste preview",
" searchreplace table template tinymcespellchecker visualblocks wordcount"
],
templates: [
{
  title: "Non-editable Example",
  description: "Non-editable example.",
  content: table
},
{
  title: "Simple Table Example",
  description: "Simple Table example.",
  content: table2
}
],
toolbar:
"insertfile a11ycheck undo redo | bold italic | forecolor backcolor | template codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image tinydrive",
content_css: '//www.tiny.cloud/css/codepen.min.css',
spellchecker_dialog: true,
spellchecker_whitelist: ['Ephox', 'Moxiecode'],
tinydrive_demo_files_url: '/docs/demo/tiny-drive-demo/demo_files.json',
tinydrive_token_provider: function (success, failure) {
success({ token: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJqb2huZG9lIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.Ks_BdfH4CWilyzLNk8S2gDARFhuxIauLa8PwhdEQhEo' });
}
};

tinymce.init(demoBaseConfig);


</script>

</body>
</html>
