document.addEventListener('DOMContentLoaded', ()=>{
    /* -------------------------------------------------------------------------------------------- 
      |   Get all element from blade page.
      |--------------------------------------------------------------------------------------------
    */
    let firstName                        = document.getElementById('firstName'); 
    let lastName                         = document.getElementById('lastName');
    let employeeEmail                    = document.getElementById('employeeEmail'); 
    let employeePhone                    = document.getElementById('employeePhone'); 
    let employeeWorkingCompanyName       = document.getElementById('employeeWorkingCompanyName'); 
    let errorFirstName                   = document.getElementById('errorFirstName'); 
    let errorLastName                    = document.getElementById('errorLastName');  
    let errorEmployeeEmail               = document.getElementById('errorEmployeeEmail');  
    let errorEmployeePhone               = document.getElementById('errorEmployeePhone');  
    let successToastMsg                  = document.getElementById('successToastMsg');   
    let errorEmployeeWorkingCompanyName  = document.getElementById('errorEmployeeWorkingCompanyName');   
    let errorToastMsg                    = document.getElementById('errorToastMsg'); 
    let errorMsgDiv                      = document.getElementById('errorMsgDiv'); 
    let addEmployeeForm                  = document.getElementById('addEmployeeForm');
    /*-----------------------------------------------------------------------------------------------------
    |  End section
    |-------------------------------------------------------------------------------------------------------
    */
    addEmployeeForm.addEventListener('submit', e => {
        e.preventDefault(); 
        let res = isValid(); 
        (res == true) ? formSubmit()  : '' ;
    });
    /*-------------------------------------------------------------------------------------------------
    |  Validation Checking.
    |--------------------------------------------------------------------------------------------------
    */
    function isValid()
    { 
        let flag = true;
        let firstNameValue                   = firstName.value.trim();
        let lastNameValue                    = lastName.value.trim();
        let employeeEmailValue               = employeeEmail.value.trim();
        let employeePhoneValue               = employeePhone.value.trim();
        let employeeWorkingCompanyID         = employeeWorkingCompanyName.options[employeeWorkingCompanyName.selectedIndex].value;
        let employeeWorkingCompanyValue      = employeeWorkingCompanyName.options[employeeWorkingCompanyName.selectedIndex].text;
        let regEmail                         = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let emailPatternCheck                = regEmail.test(employeeEmailValue);
        let phoneIsNumber                    = isNaN(employeePhoneValue);
        let phoneLength                      = employeePhoneValue.length;  
        switch(true)
        {
            case (firstNameValue == '') : 
                errorFirstName.innerHTML = "* Please put your first name here";
                    setTimeout(function(){
                        errorFirstName.innerHTML="";
                    },3000);
                    flag = false;
            break;
            case (lastNameValue == '') : 
                 errorLastName.innerHTML = "* Please put your last name here";
                    setTimeout(function(){
                        errorLastName.innerHTML="";
                    },3000);
                    flag = false;
                 break;
            case ((employeeEmailValue != "") && (emailPatternCheck == false))  : 
                errorEmployeeEmail.innerHTML = "* Please put a valid email address";
                    setTimeout(function(){
                        errorEmployeeEmail.innerHTML="";
                    },3000);
                    flag = false;
                break;
            case (employeePhoneValue != "")   : 
                   switch(true)
                   {
                        case (phoneIsNumber == true)  :
                            errorEmployeePhone.innerHTML = "* Please put number here";
                            setTimeout(function(){
                                errorEmployeePhone.innerHTML="";
                            },3000);
                        break;
                        case (phoneLength != 10)  :
                            errorEmployeePhone.innerHTML = "* Please put 10 digits only";
                            setTimeout(function(){
                                errorEmployeePhone.innerHTML="";
                            },3000);
                        break;
                   }
                break;
            case (employeeWorkingCompanyID == '')   : 
                    errorEmployeeWorkingCompanyName.innerHTML = "* Please select your organization";
                    setTimeout(function(){
                        errorEmployeeWorkingCompanyName.innerHTML="";
                    },3000);
                    flag = false;
            default :
            break;
        }
       return flag;
    }
    /*------------------------------------------------------------------------------------------------
    |  End section
    |-------------------------------------------------------------------------------------------------
    */
    function formSubmit()
    {
        const formData = new FormData();
        let firstNameValue                   = firstName.value.trim();
        let lastNameValue                    = lastName.value.trim();
        let employeeEmailValue               = employeeEmail.value.trim();
        let employeePhoneValue               = employeePhone.value.trim();
        let employeeWorkingCompanyID         = employeeWorkingCompanyName.options[employeeWorkingCompanyName.selectedIndex].value;
        formData.append('firstNameValue',firstNameValue);
        formData.append('lastNameValue',lastNameValue);
        formData.append('employeeEmailValue',employeeEmailValue);
        formData.append('employeePhoneValue',employeePhoneValue);
        formData.append('employeeWorkingCompanyID',employeeWorkingCompanyID);
        let url =  addEmployeeForm.action ;  
        let token = document.querySelector('meta[name="csrf-token"]').content; 
        fetch(url, {
            method: 'post',
            body: formData,
            headers: {
              "X-CSRF-TOKEN": token,
              "Accept": 'application/json',
            },
          }).then(function (response) {
             let result = response.status;
             console.log(response);
             switch(result)
             {
                case 200: 
                        firstName.value = '';
                        lastName.value = '';
                        employeeEmail.value = '';
                        employeePhone.value = '';
                        employeeWorkingCompanyName.value = ''; 
                        successToastMsg.style.display = 'block'; 
                        setTimeout(function(){
                            successToastMsg.style.display="none";
                        },4000);
                        setTimeout(function(){
                            window.location.href="/list-employee";
                        },4000);
                        break;
                case 500 :
                         errorToastMsg.style.display="block";
                         errorMsgDiv.innerHTML = "The e-mail address you specified is already in use.";
                         setTimeout(function(){
                            errorToastMsg.style.display="none";
                        },3000);
                       break;
                case 422 :
                        errorToastMsg.style.display="block";
                        errorMsgDiv.innerHTML = "The e-mail address or phone number you specified is already in use or select company.";
                        setTimeout(function(){
                            errorToastMsg.style.display="none";
                        },3000);
                      break;
                default:
                    break;    
             }
            return response.json();
            }).then(function (json) {  
          })
            .catch(function (error) {
        });
   }
});