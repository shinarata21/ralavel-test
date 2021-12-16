<form action="{{ url( 'register' )}}" method="POST">
  {{ csrf_field() }}
  <input type="text" name="inputName" placeholder="新メンバー名を入力">
  <input type="submit" value="登録">
</form>