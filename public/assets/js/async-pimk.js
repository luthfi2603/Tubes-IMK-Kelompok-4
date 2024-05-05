const notif = document.getElementById("notif-login");
const table = document.getElementById("table");
const tableContent = document.getElementById("table-content")
const divTombol = document.getElementById("div-tombol");
let tableItems = "";

setTimeout(() => {
    notif ? notif.classList.add("hidden") : '';
}, 1500);

const ambilData = async (url) => {
    divTombol.classList.toggle("hidden");
    table.classList.toggle("hidden");

    const response = await fetch(url);
    const data = await response.json();

    data.forEach(element => {
        if(element.email_verified_at == null){
            tableItems += `
                <tr>
                    <td>${element.name}</td>
                    <td>${element.email}</td>
                    <td>No</td>
                </tr>
            `;
        }else{
            tableItems += `
                <tr>
                    <td>${element.name}</td>
                    <td>${element.email}</td>
                    <td>Yes</td>
                </tr>
            `;
        }
    });
    
    tableContent.innerHTML = tableItems;
};