<?php
// ①DBから全データ取得
// -PDO::query(sql)を使おう
// ②foreachで表示
// -出力はエスケープしよう
function dbc()
{
  $host = "cosc360.ok.ubc.ca";
  $dbname = "db_83395822";
  $user = "83395822";
  $pass = "83395822";

  $dns = "mysql:host=$host;dbname=$dbname;charset=utf8";

  try {
    $pdo = new PDO($dns, $user, $pass,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
  } catch(PDOException $e) {
    exit($e->getMessage());
  }
}
/**
 * ファイルデータを保存
 * @param string $filename ファイル名
 * @param string $save_path 保存先のパス
 * @param string $caption 投稿の説明
 * @return bool $result
 */
function fileSave($filename, $save_path)
{
  $result = False;

  $sql = "INSERT INTO images (file_name, file_path) VALUE (?, ?)";

  try {
    $stmt = dbc()->prepare($sql);
    $stmt->bindValue(1, $filename);
    $stmt->bindValue(2, $save_path);
    $result = $stmt->execute();
    return $result;
  } catch(\Exception $e) {
    echo $e->getMessage();
    return $result;
  }

}

/**
 * ファイルデータを取得
 * @return array $fileData
 */
function getAllFile()
{
  $sql = "SELECT * FROM images";

  $fileData = dbc()->query($sql);

  return $fileData;
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}