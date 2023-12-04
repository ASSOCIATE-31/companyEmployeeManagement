document.addEventListener('DOMContentLoaded', ()=>{   
    let id                   = document.getElementById('id'); 
    let companyName          = document.getElementById('companyName');
    let companyEmail         = document.getElementById('companyEmail');
    let companyLogo          = document.getElementById('companyLogo'); 
    let updateCompanyForm    = document.getElementById('updateCompanyForm');
    let errorCompanyName     = document.getElementById('errorCompanyName'); 
    let errorCompanyEmail    = document.getElementById('errorCompanyEmail'); 
    let errorCompanyLogo     = document.getElementById('errorCompanyLogo');  
    let successToastMsg      = document.getElementById('successToastMsg');   
    let errorToastMsg        = document.getElementById('errorToastMsg'); 
    let errorMsgDiv          = document.getElementById('errorMsgDiv'); 
    updateCompanyForm.addEventListener('submit', e => {
        formSubmit();
        e.preventDefault();
        let res = isValid(); 
        (res == true) ? formSubmit()  : '' ;
    });
    function isValid()
    {  
        let flag = true;
        let companyNameValue  = companyName.value.trim(); 
        let companyEmailValue = companyEmail.value.trim();
        let companyLogoValue  = companyLogo.value.trim();
        let matchFound = false;
        var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let emailPatternCheck = regEmail.test(companyEmailValue);  
        if(companyLogoValue != "")
        {
            let filename            = companyLogo.files[0].name;
            let fileExtension       = filename.split('.').pop();
            let supportedExtensions = ['jpg','jpeg','gif','png','bmp'];
            let i = 0;
            for(i = 0; i<supportedExtensions.length; i++ )
            {
                if(fileExtension == supportedExtensions[i])
                {
                    matchFound = true; 
                    break;
                }
            }
        }  
        if(companyNameValue == '')
        {
            errorCompanyName.innerHTML = "* Please put company name here";
            setTimeout(function(){
                errorCompanyName.innerHTML="";
            },3000);
            flag = false;
        }  
        else if ((companyEmailValue != "") && (emailPatternCheck == false)) 
        {
            errorCompanyEmail.innerHTML = "* Please enter a valid email address";
            setTimeout(function(){
                companyEmailValue.innerHTML="";
            },3000);
            flag = false;
        }
        else if((companyLogoValue != "") && (matchFound == false))
        {
            errorCompanyLogo.innerHTML = "* Company logo must be greater than 100*100";
            setTimeout(function(){
                errorCompanyLogo.innerHTML="";
            },3000);
            flag = false;
        }
        return flag;
    }
    function formSubmit()
    {
        let formData = new FormData();
        let companyID  = id.value;
        let companyNameValue  = companyName.value.trim();
        let companyEmailValue = companyEmail.value.trim();
        let companyLogoValue  = companyLogo.value.trim();
        formData.append('companyID',companyID);
        formData.append('companyNameValue',companyNameValue);
        formData.append('companyEmailValue',companyEmailValue);
        formData.append('companyLogoValue', document.querySelector('#companyLogo').files[0]); console.log(formData.get('id'));
        let url =  updateCompanyForm.action ;
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
             switch(result)
             {
                case 200: 
                        successToastMsg.style.display = 'block'; 
                        setTimeout(function(){
                            successToastMsg.style.display="none";
                        },4000);
                        setTimeout(function(){
                            window.location.href="/list-company";
                        },5000);
                        break;
                case 402 :
                        errorToastMsg.style.display="block";
                        errorMsgDiv.innerHTML = " General failure.";
                        setTimeout(function(){
                            errorToastMsg.style.display="none";
                        },4000);
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