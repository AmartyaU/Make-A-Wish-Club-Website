$(document).ready(function() {

  $("#form").on("submit", function() {
    formValid = true;
    var emailIsValid = $("#email").prop("validity").valid;
    if(emailIsValid) {
      $("#emailerror").hide();
    } else {
      $("#emailerror").show();
      formValid = false;
    }
    var nameIsValid = $("#FName").prop("validity").valid;
    if(nameIsValid) {
      $("#nameError").hide();
    } else {
      $("#nameError").show();
      formValid = false;
    }
    var bnameIsValid = $("#Lname").prop("validity").valid;
    if(bnameIsValid) {
      $("#BnameError").hide();
    } else {
      $("#BnameError").show();
      formValid = false;
    }
    var subjectIsValid = $("#Subject").prop("validity").valid;
    if(subjectIsValid) {
      $("#SubjectError").hide();
    } else {
      $("#SubjectError").show();
      formValid = false;
    }
    var pNumberIsValid = $("#PNumber").prop("validity").valid;
    if(pNumberIsValid) {
      $("#PNumberError").hide();
    } else {
      $("#PNumberError").show();
      formValid = false;
    }
    var messageIsValid = $("#message").prop("validity").valid;
    if(messageIsValid) {
      $("#messageError").hide();
    } else {
      $("#messageError").show();
      formValid = false;
    }
    return formValid;
  });

  $("#uploadFile").on("submit", function() {
    formValid = true;
    var titleIsValid = $("#title").prop("validity").valid;
    if(titleIsValid) {
      $("#TitleError").hide();
    } else {
      $("#TitleError").show();
      formValid = false;
    }
    var nameIsValid = $("#location").prop("validity").valid;
    if(nameIsValid) {
      $("#LocationError").hide();
    } else {
      $("#LocationError").show();
      formValid = false;
    }
    var subjectIsValid = $("#article").prop("validity").valid;
    if(subjectIsValid) {
      $("#messageError").hide();
    } else {
      $("#messageError").show();
      formValid = false;
    }
    var bnameIsValid = $("#date").prop("validity").valid;
    if(bnameIsValid) {
      $("#DateError").hide();
    } else {
      $("#DateError").show();
      formValid = false;
    }
    var pNumberIsValid = $("#file").prop("validity").valid;
    if(pNumberIsValid) {
      $("#fileError").hide();
    } else {
      $("#fileError").show();
      formValid = false;
    }
    return formValid;
  });

  $("#archive").on("submit", function() {
    formValid = true;
    var titleIsValid = $("#money").prop("validity").valid;
    if(titleIsValid) {
      $("#moneyError").hide();
    } else {
      $("#moneyError").show();
      formValid = false;
    }
    var nameIsValid = $("#description").prop("validity").valid;
    if(nameIsValid) {
      $("#descriptionError").hide();
    } else {
      $("#descriptionError").show();
      formValid = false;
    }
    return formValid;
  });

});
