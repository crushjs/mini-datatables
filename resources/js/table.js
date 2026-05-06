document.addEventListener("DOMContentLoaded", async () => {
    const table = document.getElementById("mini-datatable");

    if (!table) return;

    const response = await fetch(table.dataset.url, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    });

    const result = await response.json();

    const tbody = table.querySelector("tbody");

    const headers = table.querySelectorAll("th");

    result.data.forEach((row) => {
        let tr = document.createElement("tr");

        headers.forEach((header) => {
            let column = header.dataset.column;

            let td = document.createElement("td");

            td.innerHTML = row[column] ?? "";

            tr.appendChild(td);
        });

        tbody.appendChild(tr);
    });
});
