{ pkgs }: {
	deps = [
   pkgs.postgresql
   pkgs.postgresql_10
		pkgs.php80
        pkgs.php80Packages.composer
	];
}