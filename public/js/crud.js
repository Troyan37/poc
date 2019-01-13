const emails = document.getElementById('emailTable');

if(emails){
    emails.addEventListener("click", e=> {
        if(e.target.className === 'delete'){
            if(confirm('Czy jesteś pewien?')){
                const emailId = e.target.getAttribute("data-id");

               fetch('/addEmail/delete/${emailId}', {
                }).then(res => window.location.reload()).catch(error => console.log("Błąd: ", error));

            }
        }
    });
}