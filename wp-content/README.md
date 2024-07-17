
```markdown
# TroyWeb Applicant Custom Theme Development

This repository contains the custom theme development work for the TroyWeb Applicant project. The work includes creating a custom WordPress theme, registering custom post types and taxonomies, and developing a post template as per the provided mockups.

## Steps Taken

1. **Local WordPress Installation**
   - Installed WordPress on the local environment.

2. **Custom Theme Development**
   - Created a custom theme named `TroyWeb Applicant`.

3. **Custom PHP File**
   - Created a `single-applicant.php` file for the custom post type template.

4. **Custom Post Types (CPT)**
   - Registered two custom post types: `Applicant` and `Core Value`.

5. **Taxonomies for Applicant CPT**
   - Created taxonomies named `Skill` and `Experience` for the `Applicant` CPT.

6. **Advanced Custom Fields (ACF)**
   - Created an ACF field group named `Spices`.
   - Retrieved data for the `Core Values` post type using the ACF plugin.

7. **Data Entry**
   - Entered the necessary data into the custom post types and fields.

8. **Database Export**
   - Exported the local WordPress database.
   - Created a `database` folder under `/wp-content` and saved the exported data as `database.sql`.

9. **GitHub Setup**
   - Set up a GitHub repository named `TroyWeb`.
   - Pushed the entire `/wp-content` folder to the GitHub repository.

## Repository Structure

```
TroyWeb/
├── wp-content/
│   ├── themes/
│   │   └── TroyWeb Applicant/
│   │       ├── single-applicant.php
│   │       ├── ...
│   ├── plugins/
│   │   └── acf/
│   │       ├── ...
│   ├── database/
│   │   └── database.sql
│   ├── ...
└── README.md
```

## Usage

1. Clone the repository to your local environment.
   ```sh
   git clone https://github.com/AaronMarty/Troyweb/tree/main
   ```
2. Import the `database.sql` file into your local WordPress database.
3. Activate the `TroyWeb Applicant` theme from the WordPress admin dashboard.
4. Ensure all necessary plugins (like ACF) are installed and activated.
