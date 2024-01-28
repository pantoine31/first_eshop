
 function showAlert(){

    var form = document.getElementById("calc");
    var xlm = form.elements["xlm"].value;
 


    var message1 = "Οι τιμές για τις οποίες θα γίνει ο υπολογισμός είναι οι:\n" +
    "Η χιλιομετρική απόσταση που έχετε βάλει είναι: " + xlm + "\n"

    
    
    alert(message1);


    // ypologismos kathe metavlitis gia na vroume to sinoliko

    let metafor;
    if (xlm <= 50) {
        metafor = 0;
      } else if (xlm >= 51 && xlm<150) {
        metafor = 1.5;
      } else if (xlm >= 151 && xlm<20000){
        metafor = 2.5;
      }
      else if (xlm >= 20001 && xlm<30000) {
        metafor = 15;
      } else if (xlm >= 30001 && xlm<80000) {
        metafor = 25;
      } else {
        metafor = 50;
      }





      var message3 = "Η τελική χρέωση για τα μεταφορικά είναι:" + metafor.toFixed(2) +"€";

      alert(message3);





}