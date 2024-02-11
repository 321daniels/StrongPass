// example sites. can we use PHP+SQL to "SELECT Site FROM Main" to show all sites?
const websites = [
  "Amazon",
  "eBay",
  "Facebook",
  "Github",
  "Google",
  "Instagram",
  "LinkedIn",
  "Netflix",
  "Pinterest",
  "Reddit",
  "Twitter",
  "Twitch",
  "Wikipedia",
  "YouTube",
];

// Function to display all dummy buttons initially
function displayAllButtons() {
  const buttonsContainer = document.getElementById("buttonsContainer");
  websites.forEach((website) => {
    const button = document.createElement("button");
    button.textContent = website;
    button.addEventListener("click", () => {
      // Should we divert to another page for password viewing, or continue to load JS elements on this page?
      console.log("Opening " + website);
    });
    buttonsContainer.appendChild(button);
  });
}

// Function to filter buttons based on search term
function filterWebsites() {
  const searchInput = document.getElementById("searchInput");
  const searchTerm = searchInput.value.toLowerCase();
  const buttonsContainer = document.getElementById("buttonsContainer");
  const buttons = buttonsContainer.querySelectorAll("button");

  buttons.forEach((button) => {
    if (button.textContent.toLowerCase().includes(searchTerm)) {
      button.style.display = "inline-block";
    } else {
      button.style.display = "none";
    }
  });
}

// Call the function to display all buttons initially
displayAllButtons();
