PLUGIN_NAME := BANKNAME-payment-plugin
GITHUB_REPO := Max-Prokofiev-leasoft/Drupal-Monorepo
TAG := v0.5.2
ZIP_FILENAME := ../../plugin/$(PLUGIN_NAME).zip
RELEASE_NAME := Release BANKNAME $(TAG)

release:
	@echo "Creating GitHub release..."
	gh release create $(TAG) "$(ZIP_FILENAME)" -n "$(RELEASE_NAME)"
	@echo "GitHub release created for $(TAG)"

.PHONY: release
