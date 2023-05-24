
function validateSignup() {
	let email = $("#email").val();
	let username = $("#username").val();
	let passwordOfForm = $("#password").val();
	let cofirmPassword = $("#confirmPassword").val();
	let emailPattern = /^[A-Za-z0-9.]+@[A-Za-z0-9]{2,}\.[A-Za-z]{2,}$/;
	
	if((username.length < 8) || (username.length > 20)) {
		$("#username").addClass("invalidData");
		$("#username").parent().find('.validate-result').removeClass("d-none");
		$("#username").parent().find('.validate-result').text("Username must be between 8-20 characters");
		return false;
	} else {
		$("#username").removeClass("invalidData");
		$("#username").parent().find('.validate-result').addClass("d-none");
	}
	if(email.length < 1) {
		$("#email").addClass("invalidData");
		$("#email").parent().find('.validate-result').removeClass("d-none");
		$("#email").parent().find('.validate-result').text("Enter email");
		return false;
	} else {
		$("#email").removeClass("invalidData");
		$("#email").parent().find('.validate-result').addClass("d-none");
	}
	
	if(!emailPattern.test(email)) {
		$("#email").addClass("invalidData");
		$("#email").parent().find('.validate-result').removeClass("d-none");
		$("#email").parent().find('.validate-result').text("Email must be in format of name@domain.com");
		return false;
	} else {
		$("#email").removeClass("invalidData");
		$("#email").parent().find('.validate-result').addClass("d-none");
	}
	
	if(!checkPassword(passwordOfForm)) {
		$("#password").addClass("invalidData");
		$("#password").parent().find('.validate-result').removeClass("d-none");
		$("#password").parent().find('.validate-result').text("Password must contain atleast one capital, one small letter, one number and min 8 characters long");
		return false;
	} else {
		$("#password").removeClass("invalidData");
		$("#password").parent().find('.validate-result').addClass("d-none");
	}
	if(passwordOfForm != cofirmPassword) {
		$("#confirmPassword").addClass("invalidData");
		$("#confirmPassword").parent().find('.validate-result').removeClass("d-none");
		$("#confirmPassword").parent().find('.validate-result').text("Passwords are not same!");
		return false;
	} else {
		$("#password").removeClass("invalidData");
		$("#password").parent().find('.validate-result').addClass("d-none");
	}
	
	return true;
}

function validateLogin() {
	let email = $("#email").val();
	let passwordOfForm = $("#password").val();
	let emailPattern = /^[A-Za-z0-9.]+@[A-Za-z0-9]{2,}\.[A-Za-z]{2,}$/;

	if(email.length < 1) {
		$("#email").addClass("invalidData");
		$("#email").parent().find('.validate-result').removeClass("d-none");
		$("#email").parent().find('.validate-result').text("Enter email");
		return false;
	} else {
		$("#email").removeClass("invalidData");
		$("#email").parent().find('.validate-result').addClass("d-none");
	}
	
	if(!emailPattern.test(email)) {
		$("#email").addClass("invalidData");
		$("#email").parent().find('.validate-result').removeClass("d-none");
		$("#email").parent().find('.validate-result').text("Email must be in format of name@domain.com");
		return false;
	} else {
		$("#email").removeClass("invalidData");
		$("#email").parent().find('.validate-result').addClass("d-none");
	}
	
	if(passwordOfForm.length < 7) {
		$("#password").addClass("invalidData");
		$("#password").parent().find('.validate-result').removeClass("d-none");
		$("#password").parent().find('.validate-result').text("PI");
		return false;
	} else {
		$("#password").removeClass("invalidData");
		$("#password").parent().find('.validate-result').addClass("d-none");
	}
	return true;
}

function validateProductDetails() {
	let productName = $("#product-name").val();
	let productDesc = $("#product-description").val();
	let originalPrice = parseInt($("#product-price").val());
	let discountPrice = parseInt($("#product-discount-price").val());

	if((productName.length < 10) || (productName.length > 150)) {
		$("#product-name").addClass("invalidData");
		$("#product-name").parent().find('.validate-result').removeClass("d-none");
		$("#product-name").parent().find('.validate-result').text("Product name must be 10-150 characters long");
		return false;
	} else {
		$("#product-name").removeClass("invalidData");
		$("#product-name").parent().find('.validate-result').addClass("d-none");
	}
	
	if((productDesc.length < 50) || (productDesc.length > 500)) {
		$("#product-description").addClass("invalidData");
		$("#product-description").parent().find('.validate-result').removeClass("d-none");
		$("#product-description").parent().find('.validate-result').text("Product description must be 50-500 characters long");
		return false;
	} else {
		$("#product-description").removeClass("invalidData");
		$("#product-description").parent().find('.validate-result').addClass("d-none");
	}
	
	if(originalPrice < 1) {
		$("#product-price").addClass("invalidData");
		$("#product-price").parent().find('.validate-result').removeClass("d-none");
		$("#product-price").parent().find('.validate-result').text("Product price must be min 1rs");
		return false;
	} else {
		$("#product-price").removeClass("invalidData");
		$("#product-price").parent().find('.validate-result').addClass("d-none");
	}
	
	
	if(discountPrice > originalPrice) {
		$("#product-discount-price").addClass("invalidData");
		$("#product-discount-price").parent().find('.validate-result').removeClass("d-none");
		$("#product-discount-price").parent().find('.validate-result').text("Discount price must be lower than original price");
		return false;
	} else {
		$("#product-discount-price").removeClass("invalidData");
		$("#product-discount-price").parent().find('.validate-result').addClass("d-none");
	}
	return true;
}

function validateSellerProfile() {
	let companyName = $("#company-name").val();
	let companyAddress = $("#company-address").val();
	let username = $("#username").val();
	let phone = $("#phone").val();
	let phonePattern = /^\d{10}$/;
	
	if((companyName.length < 5) || (companyName.length > 20)) {
		$("#company-name").addClass("invalidData");
		$("#company-name").parent().find('.validate-result').removeClass("d-none");
		$("#company-name").parent().find('.validate-result').text("Company name must be 5-20 characters long");
		return false;
	} else {
		$("#company-name").removeClass("invalidData");
		$("#company-name").parent().find('.validate-result').addClass("d-none");
	}	
	
	if(companyAddress.length < 10) {
		$("#company-address").addClass("invalidData");
		$("#company-address").parent().find('.validate-result').removeClass("d-none");
		$("#company-address").parent().find('.validate-result').text("Company Address must be more than 10 characters");
		return false;
	} else {
		$("#company-address").removeClass("invalidData");
		$("#company-address").parent().find('.validate-result').addClass("d-none");
	}
	
	if((username.length < 8) || (username.length > 20)) {
		$("#username").addClass("invalidData");
		$("#username").parent().find('.validate-result').removeClass("d-none");
		$("#username").parent().find('.validate-result').text("Username must be 8-20 characters");
		return false;
	} else {
		$("#username").removeClass("invalidData");
		$("#username").parent().find('.validate-result').addClass("d-none");
	}	
	
	if(!phonePattern.test(phone)) {
		$("#phone").addClass("invalidData");
		$("#phone").parent().find('.validate-result').removeClass("d-none");
		$("#phone").parent().find('.validate-result').text("Phone number must be 10 digits");
		return false;
	} else {
		$("#phone").removeClass("invalidData");
		$("#phone").parent().find('.validate-result').addClass("d-none");
	}	
	return true;
}

function validateBankDetails() {
	let bankNo = $("#bank-no").val();
	let bankFullName = $("#bank-full-name").val();
	let bankIfscCode = $("#bank-ifsc-code").val();
	let gstin = $("#gstin").val();
	let ifscPattern = /^[A-Za-z]{4}[\d]{7}$/;
	let gstinPattern = /^[0-9]{2}[A-Za-z]{5}[0-9]{4}[A-Z]{1}[0-9]{1}Z[0-9]{1}$/;
	
	if((bankNo.length < 11) || (bankNo.length > 18)) {
		$("#bank-no").addClass("invalidData");
		$("#bank-no").parent().find('.validate-result').removeClass("d-none");
		$("#bank-no").parent().find('.validate-result').text("Bank AC no must be 11-18 numbers long");
		return false;
	} else {
		$("#bank-no").removeClass("invalidData");
		$("#bank-no").parent().find('.validate-result').addClass("d-none");
	}	

	if(bankFullName.length <= 6) {
		$("#bank-full-name").addClass("invalidData");
		$("#bank-full-name").parent().find('.validate-result').removeClass("d-none");
		$("#bank-full-name").parent().find('.validate-result').text("Full name must be atleast 7 characters long");
		return false;
	} else {
		$("#bank-full-name").removeClass("invalidData");
		$("#bank-full-name").parent().find('.validate-result').addClass("d-none");
	}
	
	if(!ifscPattern.test(bankIfscCode)) {
		$("#bank-ifsc-code").addClass("invalidData");
		$("#bank-ifsc-code").parent().find('.validate-result').removeClass("d-none");
		$("#bank-ifsc-code").parent().find('.validate-result').text("Invalid IFSC Code");
		return false;
	} else {
		$("#bank-ifsc-code").removeClass("invalidData");
		$("#bank-ifsc-code").parent().find('.validate-result').addClass("d-none");
	}
	
	if(!gstinPattern.test(gstin)) {
		$("#gstin").addClass("invalidData");
		$("#gstin").parent().find('.validate-result').removeClass("d-none");
		$("#gstin").parent().find('.validate-result').text("Invalid GSTIN Code");
		return false;
	} else {
		$("#gstin").removeClass("invalidData");
		$("#gstin").parent().find('.validate-result').addClass("d-none");
	}
	return true;
}

function validateChangePassword() {
	let currentpassword = $("#currentPassword").val();
	let newPassword = $("#newPassword").val();
	let confirmPassword = $("#confirmPassword").val();
	
	if(currentpassword.length < 8) {
		console.log("fsdf");
		$("#currentPassword").addClass("invalidData");
		$("#currentPassword").parent().find('.validate-result').removeClass("d-none");
		$("#currentPassword").parent().find('.validate-result').text("Password must be more than 8 characters");
		return false;
	} else {
		$("#currentPassword").removeClass("invalidData");
		$("#currentPassword").parent().find('.validate-result').addClass("d-none");
	}
	if(!checkPassword(newPassword)) {
		$("#newPassword").addClass("invalidData");
		$("#newPassword").parent().find('.validate-result').removeClass("d-none");
		$("#newPassword").parent().find('.validate-result').text("Password must contain atleast one capital, one small letter, one number and min 8 characters long");
		return false;
	} else {
		$("#newPassword").removeClass("invalidData");
		$("#newPassword").parent().find('.validate-result').addClass("d-none");
	}
	if(newPassword != confirmPassword) {
		$("#confirmPassword").addClass("invalidData");
		$("#confirmPassword").parent().find('.validate-result').removeClass("d-none");
		$("#confirmPassword").parent().find('.validate-result').text("Passwords are not same!");
		return false;
	} else {
		$("#confirmPassword").removeClass("invalidData");
		$("#confirmPassword").parent().find('.validate-result').addClass("d-none");
	}	
	return true;
}

function validateBuyerProfile() {
	let username = $("#username").val();
	let phone = $("#phone").val();
	let buyerAddress = $("#shipping-address").val(); 
	let zip = $("#zipcode").val();
	let zipPattern = /^[\d]{6}$/;
	let phonePattern = /^\d{10}$/;
	if((username.length < 8) || (username.length >= 20)) {
		$("#username").addClass("invalidData");
		$("#username").parent().find('.validate-result').removeClass("d-none");
		$("#username").parent().find('.validate-result').text("Username must be 8-20 characters");
		return false;
	} else {
		$("#username").removeClass("invalidData");
		$("#username").parent().find('.validate-result').addClass("d-none");
	}	
	
	if(!phonePattern.test(phone)) {
		$("#phone").addClass("invalidData");
		$("#phone").parent().find('.validate-result').removeClass("d-none");
		$("#phone").parent().find('.validate-result').text("Phone number must be 10 digits");
		return false;
	} else {
		$("#phone").removeClass("invalidData");
		$("#phone").parent().find('.validate-result').addClass("d-none");
	}

	if(buyerAddress.length <= 10) {
		$("#shipping-address").addClass("invalidData");
		$("#shipping-address").parent().find('.validate-result').removeClass("d-none");
		$("#shipping-address").parent().find('.validate-result').text("Shipping Address must be more than 10 characters");
		return false;
	} else {
		$("#shipping-address").removeClass("invalidData");
		$("#shipping-address").parent().find('.validate-result').addClass("d-none");
	}	
	
	if(!zipPattern.test(zip)) {
		$("#zipcode").addClass("invalidData");
		$("#zipcode").parent().find('.validate-result').removeClass("d-none");
		$("#zipcode").parent().find('.validate-result').text("Invalid ZIP code");
		return false;
	} else {
		$("#zipcode").removeClass("invalidData");
		$("#zipcode").parent().find('.validate-result').addClass("d-none");
	}	
	
}


function checkPassword(password) {
    let isCaps = /[A-Z]/;
    let isSmall = /[a-z]/;
    let nums = /[\d]/;
    if((password.search(isCaps) == -1) || (password.search(isSmall) == -1) || (password.search(nums) == -1) || (password.length < 8)) {
        
        return false;
    }
    return true;;
    
    
}