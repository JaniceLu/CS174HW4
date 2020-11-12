<?php
namespace Views\Layouts;

class Header
{
  public function render(){
    echo "<!DOCTYPE html>
            <html lang=\"en\">
              <head>
                <meta charset=\"UTF-8\">
                <title>Movie Reviews</title>
                <link rel=\"stylesheet\" href=\"./src/styles/stylesheet.css\">
              </head>
              <body>
                <main>
                  <h1>Community Jigsaw</h1>";
  }
}
