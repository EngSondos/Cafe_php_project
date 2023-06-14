<?php
//*Validation On Image */
function imageValid()
{

  global $product_updated;

  //**To Sure That Input File Is Not Empty.
  //**If Input File Is Empty Set The The Old Image.

  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // File was uploaded successfully
    $image = "assets/products/" . $_FILES['image']['name'];
    // Process the file
  } else {
    // File upload error occurred
    $image =  substr($product_updated['image'], 5);
  }

  return $image;
}
