# Workstation Management

## Description
Nowadays, every company has a lot of workstations. It's a big problem for IT department to manage all of them.
### TODO: add workstations problems and nowadays solutions.
### TODO: add information about government regulations to decrease CO2 emissions.
This project is aimed to solve this problem in a open-source way, then every company can use it at no cost.

## Getting started
### Install dependencies
#### Using Docker (recommended)
* To install dependencies, in the root folder, run: `docker run --rm -it -v $(pwd):/app bitnami/php-fpm composer update`
* **Note:** In my system, it needs to change owner, then if your database didn't raise up, just do the same: `sudo chown -R ${USER}: .`

## Sail Installation & Usage
* In my local system, I used `mariadb`. but feel free to use anything you want. It should work on different RDBMS.
* Also, I have `alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'` in my `.zshrc` file. helps for easy access to `sail` commands.
* sail up -d
* sail pest

## Usage
* To run tests, in the root folder, run: `sail test` or `sail pest`
* to visit the web page, in the browser, go to `http://localhost`

## Contributing
Everyone is welcome to contribute to this project. just open a pull request and I will review it quickly.

## Predictable future extends
1. using different type of files to input data
2. using form to enter data
3. lists should be filterable and sortable
4. lists need to have pagination

## Thinking Process
I've logged my thinking process to have better understanding of the problem before starting to code.

[ThinkingProcess.md](docs%2FThinkingProcess.md)

## Tasks Management
I believe every great project starts from a good plan. Planning is the key to success & improvement.
Before starting to code, I think about the tasks I want to accomplish.
Also I do everything in a incremental way. I start with everything that I can imagine in a limited time-box and then during the development, I add and prioritize more tasks whenever I get idea.

[Tasks Management List](docs/task management/Tasks.md)
