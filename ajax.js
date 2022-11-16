/* ** SORT ** */

let sortBtn = document.getElementById("sort-btn");
let tbody = document.getElementById('tbody');

let searchBox = document.getElementById('search-box');

sortBtn.addEventListener('click', (event) => {
  searchBox.value = "";

  $.ajax({
    url: 'sort.php',
    type: 'POST',
    data: {
      sortType: "title",
    },
    success: (response) => {
      let games = JSON.parse(response);
      let html = "";

      games.forEach((game) => {
        if (game.user_id == 0) {
          html += `<tr>
                    <td>${game.game_name}</td>
                    <td>${game.developer}</td>
                    <td>${game.genre}</td>
                    <td>${game.edition}</td>
                    <td>
                      <form method="POST">
                        <button type="submit" class="btn" name="pick"><i class="fas"></i>Pick</button>
                        <input type="hidden" name="game_id" value="${game.game_id}">
                      </form>
                    </td>
                  </tr>`;
        }

        tbody.innerHTML = html;
      });
    }
  });
});


searchBox.addEventListener('keyup', (event) => {
  let text = searchBox.value;

  $.ajax({
    url: 'search.php',
    type: 'POST',
    data: {
      search: text,
    },
    success: (response) => {
      let games = JSON.parse(response);
      let html = "";

      games.forEach((game) => {
        if (game.user_id == 0) {
          html += `<tr>
                    <td>${game.game_name}</td>
                    <td>${game.developer}</td>
                    <td>${game.genre}</td>
                    <td>${game.edition}</td>
                    <td>
                      <form method="POST">
                        <button type="submit" class="btn" name="pick"><i class="fas"></i>Pick</button>
                        <input type="hidden" name="game_id" value="${game.game_id}">
                      </form>
                    </td>
                  </tr>`;
        }
      });

      tbody.innerHTML = html;
    }
  });

});


