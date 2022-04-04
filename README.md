## Before
```
composer install
```

## Example running
```
php solid_runner SRP
```

## Principles
| Name | Description |
| -------- | ----------- |
| [Single-responsibility Principle (SRP)](src/SingleResponsibility) | A class should have one and only one reason to change, meaning that a class should have only one job. |
| [Open-closed Principle (OCP)](src/OpenClosed) | Objects or entities should be open for extension but closed for modification. |
| [Liskov Substitution Principle (LSP)](src/LiskovSubstitution) | This means that every subclass or derived class should be substitutable for their base or parent class. |
| [Interface Segregation Principle (ISP)](src/InterfaceSegregation) | A client should never be forced to implement an interface that it doesn’t use, or clients shouldn’t be forced to depend on methods they do not use. |
| [Dependency Inversion Principle (DIP)](src/DependencyInversion) | Entities must depend on abstractions, not on concretions. It states that the high-level module must not depend on the low-level module, but they should depend on abstractions. |