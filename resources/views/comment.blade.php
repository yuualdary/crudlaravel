<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="app">
        <h3>Comment</h3>
        <input type="text" v-model="comment" @keyup.enter="addComment">
        <h3>Comment As</h3>

        <input type="text" v-model="user_comment" @keyup.enter="addComment">

        <li v-for="(comment,index) in comments">
        <span>@{{ comment.comment }} from / @{{comment.user_comment}} at / @{{comment.comment_created_at}} <button type="button" v-on:click="removeComment(index, comment)">X</button></span>
        </li>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

        <script>
                var today = new Date();
                var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                var dateTime = date+' '+time;
            new Vue({
                el:"#app",
                data:{
                    comment:"",
                    user_comment:"",
                    comment_created_at :dateTime,
                    comments:[]
                },
                methods : {

                    addComment : function(){

                        let comment = this.comment.trim();
                        let user_comment = this.user_comment.trim();
                        let comment_created_at = this.comment_created_at.trim();


                        // console.log(varComment);
                        if(comment){
                            this.$http.post('/api/storeComment',{comment: comment, user_comment:user_comment}).then(response => {

                            // get body data
                            // this.someData = response.body;
                            this.comments.unshift(
                                {
                                    comment : comment, user_comment : user_comment, comment_created_at : comment_created_at,
                                }
                            )
                            });

                            
                        }
                    },

                    removeComment : function(index, comment){
                        this.$http.post('/api/deleteComment/' + comment.comment_id).then(response => {
                        this.comments.splice(index,1);
                    });
                    }
                },
                mounted : function(){
                    this.$http.get('/api/comment').then(response => {
                        // get body data
                            let result = response.body.data;
                            this.comments =result;
                            // console.log(response)
// error callback
                    });

                }
            });
        </script>
</body>
</html>