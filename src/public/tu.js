(function($){
	var App = {

		init: function(){
			this.list = $('#liste');
			console.log(this.list);
		},

		loadArticles: function(){
			console.log("loading articles");
			var parent = this;
			$.get("/articles", function(data){
				parent.displayArticles(data);
			});
		},

		displayArticles: function(data){
			data.forEach(function(element) {
				console.log(element);
				var row = document.createElement('div');
				row.className = "list_row";

				var title = document.createElement('div');
				title.className = "title";
				title.innerHTML = element.title;
				row.appendChild(title);

				var author = document.createElement('div');
				author.className = "author";
				author.innerHTML = "Skrevet av: " + element.name;
				row.appendChild(author);
				
				var published = document.createElement('div');
				published.className = "published";
				published.innerHTML = "Publisert: " + element.publish_date;
				row.appendChild(published);
				
				var content = document.createElement('div');
				content.className = "content";
				content.innerHTML = element.content;
				row.appendChild(content);
				
				this.list.append(row);

			}, this);
		}
	}

	$(document).ready(function(){
		console.log("dom ready");
		App.init();
		App.loadArticles();
	});
})(jQuery);
