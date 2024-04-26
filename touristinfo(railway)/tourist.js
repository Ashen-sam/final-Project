document.addEventListener("DOMContentLoaded", function () {
    const touristPostsContainer = document.getElementById("tourist-posts");
  
    // Sample data for posts
    const posts = [
      { title: "Post 1", content: "Content for post 1..." },
      { title: "Post 2", content: "Content for post 2..." },
      { title: "Post 2", content: "Content for post 2..." },
      { title: "Post 2", content: "Content for post 2..." },
      // Add more posts as needed
    ];
  
    // Display posts
    posts.forEach((post, index) => {
        const postElement = document.createElement("div");
        postElement.classList.add("post");
        postElement.innerHTML = `
          <img src="path/to/your/image${index + 1}.jpg" alt="Post Image">
          <h2>${post.title}</h2>
          <p>${post.content}</p>
          <button onclick="showDetails(${index})">Read More</button>
        `;
        touristPostsContainer.appendChild(postElement);
      });
      
  
    // Search functionality
    const searchInput = document.createElement("input");
    searchInput.type = "text";
    searchInput.id = "search-input";
    searchInput.placeholder = "Search...";
    searchInput.addEventListener("input", function () {
      const searchTerm = this.value.toLowerCase();
      const filteredPosts = posts.filter(post =>
        post.title.toLowerCase().includes(searchTerm) || post.content.toLowerCase().includes(searchTerm)
      );
      displayPosts(filteredPosts);
    });
    document.body.insertBefore(searchInput, touristPostsContainer);
  
    // Function to display posts
    function displayPosts(postsToShow) {
      touristPostsContainer.innerHTML = "";
      postsToShow.forEach((post, index) => {
        const postElement = document.createElement("div");
        postElement.classList.add("post");
        postElement.innerHTML = `
          <h2>${post.title}</h2>
          <p>${post.content}</p>
          <button onclick="showDetails(${index})">Read More</button>
        `;
        touristPostsContainer.appendChild(postElement);
      });
    }
  
    // Function to show details when "Read More" is clicked
    window.showDetails = function (index) {
      alert(`Details for ${posts[index].title}: ${posts[index].content}`);
    };
  });
  