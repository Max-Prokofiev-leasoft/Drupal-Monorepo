PLUGIN_NAME := ems-payment-plugin
GITHUB_REPO := Max-Prokofiev-leasoft/Drupal-Monorepo
TAG := v1.0.0
ZIP_FILENAME := ../../plugin/$(PLUGIN_NAME).zip
RELEASE_NAME := Release EMS $(TAG)

release:
	@echo "Creating GitHub release..."
	gh release create $(TAG) "$(ZIP_FILENAME)" -n "$(RELEASE_NAME)"
	@echo "GitHub release created for $(TAG)"

.PHONY: release
