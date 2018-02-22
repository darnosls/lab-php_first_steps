<?php
interface iContentModel
{
  public function show();
  public function showByIdContent($id);
  public function delete($id);
  public function update($id);

}
