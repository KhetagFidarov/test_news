<?php

namespace App;
use PDO;

class Posts extends DBConnect
{
    public function index($category,$page,$showPosts): array
    {
        $is_delete = 0;

        $placeholders = implode(',', array_fill(0, count($category), '?'));

        $sql = "SELECT COUNT(*) FROM posts WHERE is_delete = ? AND category_id IN ($placeholders)";
        $stm = $this->pdo()->prepare($sql);
        $array = [$is_delete];

        foreach ($category as $cat) {
            $array[] = $cat;
        }

        $stm->execute($array);
        $total_posts = $stm->fetchColumn();

        $posts_per_page = $showPosts ?? 3;
        $total_pages = ceil($total_posts / $posts_per_page);
        $current_page = isset($page) ? $page : 1;

        $offset = ($current_page - 1) * $posts_per_page;
        $sql = "SELECT ps.id, ps.post_name AS name, ps.is_view, ps.category_id, pc.category_name, pi.image_name,pi.directory
            FROM posts AS ps 
            JOIN posts_category AS pc ON ps.category_id = pc.id
            JOIN posts_image AS pi ON ps.image_id = pi.id 
            WHERE ps.is_delete = ? AND ps.category_id IN ($placeholders)
            LIMIT $offset, $posts_per_page";
        $stm = $this->pdo()->prepare($sql);

        $array = [$is_delete];

        foreach ($category as $cat) {
            $array[] = $cat;
        }
        $stm->execute($array);

       return  $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function total_pages($category,$showPosts): int {

        $is_delete = 0;

        $placeholders = implode(',', array_fill(0, count($category), '?'));

        $sql = "SELECT COUNT(*) FROM posts WHERE is_delete = ? AND category_id IN ($placeholders)";
        $stm = $this->pdo()->prepare($sql);
        $array = [$is_delete];

        foreach ($category as $cat) {
            $array[] = $cat;
        }

        $stm->execute($array);
        $total_posts = $stm->fetchColumn();

        $posts_per_page =  $showPosts ?? 3;
        return ceil($total_posts / $posts_per_page);
    }

    public function post($id): array|false {
        $stm = $this->pdo()->prepare("SELECT ps.id, ps.post_name AS name, ps.is_view, ps.category_id, pc.category_name, pi.image_name,pi.directory
                                            FROM posts AS ps 
                                            JOIN posts_category AS pc ON ps.category_id = pc.id
                                            JOIN posts_image AS pi ON ps.image_id = pi.id WHERE ps.is_delete = :is_delete AND ps.id= :id
                                            ");
        $stm->execute([':is_delete'=>0,':id'=>$id]);

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function destroy($id):bool {
        $stm = $this->pdo()->prepare("UPDATE posts as p SET is_delete = :is_delete WHERE p.id= :id");

        $stm->execute([':id'=>$id,'is_delete'=>1]);

        return true;
    }

    public function update($name,$is_view,$id):void {

        if(!empty($name)){
            $stm = $this->pdo()->prepare("UPDATE posts as p SET post_name = :name WHERE p.id= :id");
            $stm->execute([':name'=>$name,':id'=>$id]);
        }

        if(isset($is_view)){
            $stm = $this->pdo()->prepare("UPDATE posts as p SET is_view = :is_view WHERE p.id= :id");
            $stm->execute([':is_view'=>$is_view,':id'=>$id]);
        }


    }

    public function saveImage($file,$id): void {

        $target_dir = "../images/";
        $filename = $file['name'];
        $target_base = "images/". $filename;;

        $target_file = $target_dir . basename($file["name"]);

        move_uploaded_file($file["tmp_name"], $target_file);

        $stm = $this->pdo()->prepare("UPDATE posts_image as pi SET image_name = :name,directory= :dir WHERE pi.post_id= :id");

        $stm->execute([':name'=>$filename,':dir'=>$target_base,':id'=>$id]);
    }


}
