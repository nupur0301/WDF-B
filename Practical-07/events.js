let allEvents = [];
let currentPage = 1;
const eventsPerPage = 5;
// Fetch JSON
fetch("json/events.json")
.then(response => response.json())
.then(events => {
    allEvents = events;
    applyFilters();
})
.catch(error => {
    console.log("Error loading JSON:", error);
});

// Display Events
function displayEvents(events){
    let eventTable = document.getElementById("eventTable");
    eventTable.innerHTML = "";
    let start = (currentPage - 1) * eventsPerPage;
    let end = start + eventsPerPage;
    let pageEvents = events.slice(start, end);
    if(pageEvents.length == 0){
        eventTable.innerHTML = `
            <tr>
                <td colspan="3" style="text-align:center;color:red;">
                    No Events Found
                </td>
            </tr>
        `;
    }
    else{
        pageEvents.forEach(function(event){
            eventTable.innerHTML += `
                <tr>
                    <td>${event.date}</td>
                    <td>${event.title}</td>
                    <td>${event.venue}</td>
                </tr>
            `;
        });
    }
    let totalPages = Math.ceil(events.length / eventsPerPage);
    if(totalPages == 0){
        totalPages = 1;
    }
    document.getElementById("pageInfo").innerHTML =
        "Page " + currentPage + " of " + totalPages;

}
// Search + Filter + Sort
function applyFilters(){
    let keyword =document.getElementById("searchInput").value.toLowerCase();
    let venue =document.getElementById("venueFilter").value;
    let sortOrder =document.getElementById("sortOrder").value;
    let filteredEvents = allEvents.filter(function(event){
        let matchesSearch =event.title.toLowerCase().includes(keyword);
        let matchesVenue =(venue == "All") || (event.venue == venue);
        return matchesSearch && matchesVenue;
    });
    if(sortOrder == "asc"){
        filteredEvents.sort(function(a,b){
            return new Date(a.date) - new Date(b.date);
        });
    }
    else if(sortOrder == "desc"){
        filteredEvents.sort(function(a,b){
            return new Date(b.date) - new Date(a.date);
        });
    }
    displayEvents(filteredEvents);
    window.filteredEvents = filteredEvents;
}
// Search
document.getElementById("searchInput")
.addEventListener("keyup",function(){
    currentPage = 1;
    applyFilters();
});
// Filter
document.getElementById("venueFilter")
.addEventListener("change",function(){
    currentPage = 1;
    applyFilters();
});
// Sort
document.getElementById("sortOrder")
.addEventListener("change",function(){
    currentPage = 1;
    applyFilters();
});
// Previous Button
document.getElementById("prevBtn")
.addEventListener("click",function(){
    if(currentPage > 1){
        currentPage--;
        displayEvents(window.filteredEvents);
    }
});
// Next Button
document.getElementById("nextBtn")
.addEventListener("click",function(){
    let totalPages =Math.ceil(window.filteredEvents.length / eventsPerPage);
    if(currentPage < totalPages){
        currentPage++;
        displayEvents(window.filteredEvents);
    }
});